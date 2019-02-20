<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class XmuAuthenticator extends AbstractFormLoginAuthenticator
{
    use TargetPathTrait;

    private $entityManager;
    private $router;
    private $container;

    public function __construct(EntityManagerInterface $entityManager, RouterInterface $router, ContainerInterface $container)
    {
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->container = $container;
    }

    public function supports(Request $request)
    {
        return 'app_login' === $request->attributes->get('_route')
            && $request->isMethod('GET')
            && $request->query->has('ticket');
    }

    public function getCredentials(Request $request)
    {
        /** @var \GuzzleHttp\Client $client */
        $client   = $this->container->get('eight_points_guzzle.client.xmu_cas');
        $response = $client->get('/authserver/serviceValidate', ['query' => [
            'ticket' => $request->query->get('ticket'),
            'service' => 'https://learningcommons.xmu.edu.cn/auth/callback',
        ]]);

        $responseString = (string)$response->getBody();
        $success = preg_match("#authenticationSuccess#", $responseString);

        if ($success) {
            $matches = array();
            preg_match("#<cas:eduPersonStudentID>(\d+)</cas:eduPersonStudentID>#", $responseString, $matches);
            $studentNumber = $matches[1];

            $matches = array();
            preg_match("#<cas:cn>(.*)</cas:cn>#", $responseString, $matches);
            $name = $matches[1];

            $matches = array();
            preg_match("#<cas:eduPersonOrgDN>(.*)</cas:eduPersonOrgDN>#", $responseString, $matches);
            $college = $matches[1];

            $credentials = [
                'success' => true,
                'studentNumber' => $studentNumber,
                'name' => $name,
                'college' => $college,
            ];

            return $credentials;
        } else {
            throw new CustomUserMessageAuthenticationException('CAS authentication error.');
        }
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['studentNumber' => $credentials['studentNumber']]);

        if (!$user) {
            $user = new User();
            $user->setStudentNumber($credentials['studentNumber'])
                ->setName($credentials['name'])
                ->setCollege($credentials['college'])
                ->setRoles(array('ROLE_VOLUNTEER'));
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }

        return $user;
    }

    /**
     * @param mixed $credentials
     * @param User $user
     * @return bool
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }

        return new RedirectResponse($this->router->generate('app_index'));
    }

    protected function getLoginUrl()
    {
        return $this->router->generate('app_login');
    }
}
