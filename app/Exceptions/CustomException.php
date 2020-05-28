<?php
namespace App\Exceptions;


use Symfony\Component\HttpKernel\Exception\HttpException;

Abstract class CustomException extends HttpException
{
    /**
     * CustomException constructor.
     * @param $statusCode
     * @param null $message
     * @param \Exception|null $previous
     * @param array $headers
     * @param int $code
     */
    public function __construct($statusCode, $message = null, \Exception $previous = null, array $headers = array(), $code = 0)
    {
        parent::__construct(200, $message, $previous, $headers, $statusCode);
    }
}