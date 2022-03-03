<?php
declare(strict_types=1);

namespace App;

use Cake\Core\Configure;
use Cake\Core\ContainerInterface;
use Cake\Datasource\FactoryLocator;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\ORM\Locator\TableLocator;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Authentication\Middleware\AuthenticationMiddleware;
use Cake\Routing\Router;
use Psr\Http\Message\ServerRequestInterface;

    

class Application extends BaseApplication implements AuthenticationServiceProviderInterface
{
    public function bootstrap(): void
    {
      parent::bootstrap();
      if (PHP_SAPI === 'cli') {
        $this->bootstrapCli();
      } else {
        FactoryLocator::add(
          'Table',
          (new TableLocator())->allowFallbackClass(false)
        );
      }
        if (Configure::read('debug')) {
            $this->addPlugin('DebugKit');
        }
    }

    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            ->add(new ErrorHandlerMiddleware(Configure::read('Error')))
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))
            ->add(new BodyParserMiddleware())
            ->add(new CsrfProtectionMiddleware([
              'httponly' => true,
            ]))
            ->add(new RoutingMiddleware($this))
            ->add(new AuthenticationMiddleware($this));

        return $middlewareQueue;
    }

    public function services(ContainerInterface $container): void
    {
    }

    protected function bootstrapCli(): void
    {
        $this->addOptionalPlugin('Cake/Repl');
        $this->addOptionalPlugin('Bake');
        $this->addPlugin('Migrations');
        // Load more plugins here
    }

    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
    {
        $authenticationService = new AuthenticationService([
            'unauthenticatedRedirect' => Router::url('/users/login'),
            'queryParam' => 'redirect',
        ]);

        $authenticationService->loadIdentifier('Authentication.Password', [
            'fields' => [
                'username' => 'email',
                'password' => 'password',
            ]
        ]);

        $authenticationService->loadAuthenticator('Authentication.Session');
        
        $authenticationService->loadAuthenticator('Authentication.Form', [
            'fields' => [
                'username' => 'email',
                'password' => 'password',
            ],
            'loginUrl' => Router::url('/users/login'),
        ]);

        return $authenticationService;
    }
}
