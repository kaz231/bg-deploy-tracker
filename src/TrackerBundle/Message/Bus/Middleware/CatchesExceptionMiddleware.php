<?php
namespace TrackerBundle\Message\Bus\Middleware;

use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;

/**
 * Class CatchesExceptionMiddleware
 * @package TrackerBundle\Message\Bus\Middleware
 */
class CatchesExceptionMiddleware implements MessageBusMiddleware
{
    /** @var \Exception|null */
    private $exception;

    /** @var bool */
    private $catching = false;

    /**
     * {@inheritdoc}
     */
    public function handle($message, callable $next)
    {
        try {
            $next($message);
        } catch (\Exception $exception) {
            $this->catchException($exception);
        }
    }

    /**
     * @return \Exception|null
     */
    public function releaseException()
    {
        $exception = $this->exception;
        $this->exception = null;

        return $exception;
    }

    public function enableCatching()
    {
        $this->catching = true;
    }

    public function disableCatching()
    {
        $this->catching = false;
    }

    /**
     * @param \Exception $exception
     */
    private function catchException(\Exception $exception)
    {
        $this->rethrowExceptionIfCatchingDisabled($exception);
        if ($this->exception) {
            throw new \LogicException('More than one exception occurred');
        }
        $this->exception = $exception;
    }

    /**
     * @param \Exception $exception
     * @throws \Exception
     */
    private function rethrowExceptionIfCatchingDisabled(\Exception $exception)
    {
        if ($this->catching) {
            return;
        }
        throw $exception;
    }
}
