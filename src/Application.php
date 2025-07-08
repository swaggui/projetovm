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

class Application extends BaseApplication
{
    public function bootstrap(): void
    {
        parent::bootstrap();
        $this->addPlugin('CakePdf');
        if (PHP_SAPI === 'cli') {
            $this->bootstrapCli();
        }
        if (file_exists(CONFIG . 'bootstrap.php')) {
            require_once CONFIG . 'bootstrap.php';
        }
    }

    // Este método está agora com a ordem correta
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            ->add(new ErrorHandlerMiddleware(Configure::read('Error'), $this))
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))
            ->add(new RoutingMiddleware($this))
            ->add(new BodyParserMiddleware())
            ->add(new CsrfProtectionMiddleware([
                'httponly' => true,
            ]));

        return $middlewareQueue;
    }

    protected function bootstrapCli(): void
    {
        if (!$this->plugins->has('Bake')) {
            try {
                $this->addPlugin('Bake');
            } catch (MissingPluginException $e) {
                // Não falhar
            }
        }
    }

    public function services(ContainerInterface $container): void
    {
    }
}
