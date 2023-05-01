<?php

declare(strict_types=1);

namespace App\Controller;

use App\Helper\ApiResponse;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    use ApiResponse;

    #[Inject]
    protected ContainerInterface $container;

    #[Inject]
    protected RequestInterface $request;

    #[Inject]
    protected ResponseInterface $response;

//    protected int $code = 200;
//    protected array $headers = [];
//    protected array $data = [];
//
//    public function setCode($code): static
//    {
//        $this->code = $code;
//        return $this;
//    }
//
//    public function setHeaders($headers): static
//    {
//        $this->headers = $headers;
//        return $this;
//    }
//
//    public function responsed()
//    {
//        $res = $this->response
//            ->withStatus($this->code)
//            ->withBody(new SwooleStream(json_encode($this->data)));
//        if ($this->headers) {
//            foreach ($this->headers as $key => $value) {
//                $res->withHeader($key, $value);
//            }
//        }
//        return $res;
//    }
//
//    public function wrapperResponse($data, $status = true, $code = null): \Psr\Http\Message\ResponseInterface
//    {
//        if ($code) $this->setCode($code);
//
//        $this->data = array_merge($data, [
//            'status' => $status,
//            'code' => $this->code
//        ]);
//
//        return self::responsed();
//    }
//
//    // message
//    public function message($message, $status = true, $code = 200): \Psr\Http\Message\ResponseInterface
//    {
//        return $this->setCode($code)->wrapperResponse([
//            'message' => $message
//        ], $status);
//    }
//
//    public function success($message = 'success', $code = 200, $status = true): \Psr\Http\Message\ResponseInterface
//    {
//        return $this->message($message, $status, $code);
//    }
//
//    public function created($message = 'created', $code = 201, $status = true): \Psr\Http\Message\ResponseInterface
//    {
//        return $this->message($message, $status, $code);
//    }
//
//    public function failed($message = 'failed', $code = 400, $status = false): \Psr\Http\Message\ResponseInterface
//    {
//        return $this->message($message, $code, $status);
//    }
//
//    public function notFound($message = 'not found', $code = 404, $status = false): \Psr\Http\Message\ResponseInterface
//    {
//        return $this->message($message, $code, $status);
//    }
//
//    public function error($message = 'Internal error', $code = 500, $status = false): \Psr\Http\Message\ResponseInterface
//    {
//        return $this->message($message, $code, $status);
//    }
//
//    // data
//    public function data($data, $code = 200, $status = true): \Psr\Http\Message\ResponseInterface
//    {
//        return $this->setCode($code)->wrapperResponse([
//            'data' => $data
//        ], $status);
//    }
//
//    // 资源
//    public function resource($data, $code = 200, $status = true)
//    {
//
//    }

}
