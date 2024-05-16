<?php

declare(strict_types=1);

namespace Tests\Middleware;

use Lion\Bundle\Exceptions\MiddlewareException;
use Lion\Bundle\Middleware\RouteMiddleware;
use Lion\Request\Http;
use Lion\Request\Status;
use Lion\Test\Test;
use Tests\Providers\EnviromentProviderTrait;

class RouteMiddlewareTest extends Test
{
    use EnviromentProviderTrait;

    private RouteMiddleware $routeMiddleware;

    protected function setUp(): void
    {
        $this->loadEnviroment();

        $this->routeMiddleware = new RouteMiddleware();
    }

    public function testProtectRouteListWithoutHeader(): void
    {
        $this
            ->exception(MiddlewareException::class)
            ->exceptionMessage('secure hash not found')
            ->exceptionStatus(Status::SESSION_ERROR)
            ->exceptionCode(Http::HTTP_UNAUTHORIZED)
            ->expectLionException(function (): void {
                $this->routeMiddleware->protectRouteList();
            });
    }

    public function testProtectedRouteListDiferentHash(): void
    {
        $this
            ->exception(MiddlewareException::class)
            ->exceptionMessage('you do not have access to this resource')
            ->exceptionStatus(Status::SESSION_ERROR)
            ->exceptionCode(Http::HTTP_UNAUTHORIZED)
            ->expectLionException(function (): void {
                $_SERVER['HTTP_LION_AUTH'] = 'ff1d1bcda9afa5873bdc8205c11e880a43351ea56dc059f6544116961f6f5c0e';

                $this->routeMiddleware->protectRouteList();
            });
    }
}
