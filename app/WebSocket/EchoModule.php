<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\WebSocket;

use Swoft\Co;
use Swoft\Http\Message\Request;
use Swoft\Redis\Redis;
use Swoft\Session\Session;
use Swoft\WebSocket\Server\Annotation\Mapping\OnClose;
use Swoft\WebSocket\Server\Annotation\Mapping\OnMessage;
use Swoft\WebSocket\Server\Annotation\Mapping\OnOpen;
use Swoft\WebSocket\Server\Annotation\Mapping\WsModule;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;
use function server;

/**
 * Class EchoModule
 *
 * @WsModule("echo")
 */
class EchoModule
{
    /**
     * @OnOpen()
     * @param Request $request
     * @param int     $fd
     */
    public function onOpen(Request $request, int $fd): void
    {
    }

    /**
     * @OnMessage()
     * @param Server $server
     * @param Frame  $frame
     */
    public function onMessage(Server $server, Frame $frame): void
    {
        $server->push($frame->fd, 'Recv: ' . $frame->data);
    }


    /**
     * @OnClose()
     * @param Server $server
     * @param int $fd
     * @author su
     * Date 19-5-5 下午12:29
     */
    public function onClose(Server $server, int $fd)
    {
        Redis::del('li');
    }
}
