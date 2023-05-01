<?php

namespace App\Helper;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Resource\Json\JsonResource;

trait ApiResponse
{

    #[Inject]
    protected ResponseInterface $response;

    // 当放回数据时 ['status' => true , 'code' => 200, data => '' ]
    // 当返回消息时 ['status' => true, 'code' => 200,'message' => 'created']

    protected int $code = 200;
    protected array $headers = [];
    protected array $data = [];

    public function setCode($code): static
    {
        $this->code = $code;
        return $this;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function setHeaders($headers): static
    {
        $this->headers = $headers;
        return $this;
    }

    public function responsed()
    {
        $res = $this->response
            ->withStatus($this->getCode())
            ->withBody(new SwooleStream(json_encode($this->data)));
        if ($this->headers) {
            foreach ($this->headers as $key => $value) {
                $res->withHeader($key, $value);
            }
        }
        return $res;
    }

    public function wrapperResponse($data, $status = true, $code = null): \Psr\Http\Message\ResponseInterface
    {
        if ($code) $this->setCode($code);

        $this->data = array_merge($data, [
            'status' => $status,
            'code' => $this->getCode()
        ]);

        return self::responsed();
    }

    // message
    public function message($message, $code = 200, $status = true): \Psr\Http\Message\ResponseInterface
    {
        return $this->setCode($code)->wrapperResponse([
            'message' => $message
        ], $status, $code);
    }

    public function success($message = 'success', $code = 200, $status = true): \Psr\Http\Message\ResponseInterface
    {
        return $this->message($message, $code, $status);
    }

    public function created($message = 'created', $code = 201, $status = true): \Psr\Http\Message\ResponseInterface
    {
        return $this->message($message, $code, $status);
    }

    public function failed($message = 'failed', $code = 400, $status = false): \Psr\Http\Message\ResponseInterface
    {
        return $this->message($message, $code, $status);
    }

    public function notFound($message = 'not found', $code = 404, $status = false): \Psr\Http\Message\ResponseInterface
    {
        return $this->message($message, $code, $status);
    }

    public function error($message = 'Internal error', $code = 500, $status = false): \Psr\Http\Message\ResponseInterface
    {
        return $this->message($message, $code, $status);
    }

    // data
    public function data($data, $code = 200, $status = true): \Psr\Http\Message\ResponseInterface
    {
        return $this->setCode($code)->wrapperResponse([
            'data' => $data
        ], $status);
    }

    // 资源（特殊處理）
    public function resource(JsonResource $resource, $data = [], $code = 200, $status = true): \Psr\Http\Message\ResponseInterface
    {
        if ($code) $this->setCode($code);

        return $resource->additional(array_merge([
            'status' => $status,
            'code' => $this->getCode(),
        ], $data))->toResponse();
    }

}