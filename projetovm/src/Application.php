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

        // Carregar plugins
        $this->addPlugin('CakePdf'); // Adicione esta linha

        if (PHP_SAPI === 'cli') {
            $this->bootstrapCli();
        }

        // Carregar configurações do bootstrap.php
        if (file_exists(CONFIG . 'bootstrap.php')) {
            require_once CONFIG . 'bootstrap.php';
        }
    }

    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            ->add(new RoutingMiddleware($this))
            ->add(new ErrorHandlerMiddleware(Configure::read('Error'), $this))
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))
            ->add(new BodyParserMiddleware())
            ->add(new CsrfProtectionMiddleware([
                'httponly' => true,
            ]));

        return $middlewareQueue;
    }

    protected function bootstrapCli(): void
    {
        // Carregar o plugin Bake apenas se não estiver carregado
        if (!$this->plugins->has('Bake')) {
            try {
                $this->addPlugin('Bake');
            } catch (MissingPluginException $e) {
                // Não falhar se o plugin Bake não estiver carregado
            }
        }
    }


        public function services(ContainerInterface $container): void
    {
    }
}
