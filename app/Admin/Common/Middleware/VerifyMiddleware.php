<?php


namespace App\Admin\Common\Middleware;

use App\Admin\Common\Service\JwtService;
use Swoft\Context\Context;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Http\Server\Contract\MiddlewareInterface;

/**
 * @Bean(name="VerifyMiddleware",scope=Bean::SINGLETON)
 */
class VerifyMiddleware implements MiddlewareInterface
{
    /**
     * Process an incoming server request.
     *
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     * @inheritdoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $path = $request->getUri()->getPath();
        if ('/auth/login' == $path || substr($path, 0, 7) != '/system'){
            return $handler->handle($request);
        }
        try {
            $request->admin = (array)JwtService::decode();
        } catch (\Exception $e) {
            $json     = ['msg' => 'Unauthorized', 'code' => 401];
            $response = Context::get()->getResponse();
            return $response->withData($json)->withStatus(401);
        }
        return $handler->handle($request);
    }

}
