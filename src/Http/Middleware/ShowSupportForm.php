<?php

namespace Spatie\SupportForm\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class ShowSupportForm
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (! config('support-form.enabled')) {
            return $response;
        }

        if (! $response instanceof Response) {
            return $response;
        }

        if (! $this->containsBodyTag($response)) {
            return $response;
        }

        return $this->addSupportFormToResponse($response);
    }

    protected function containsBodyTag(Response $response): bool
    {
        return $this->getLastClosingBodyTagPosition($response->getContent()) !== false;
    }

    protected function getLastClosingBodyTagPosition(string $content = ''): bool | int
    {
        return strripos($content, '</body>');
    }

    protected function addSupportFormToResponse(Response $response): Response
    {
        $content = $response->getContent();

        $closingBodyTagPosition = $this->getLastClosingBodyTagPosition($content);

        $content = ''
            . substr($content, 0, $closingBodyTagPosition)
            . view('support-form::outer')->render()
            . substr($content, $closingBodyTagPosition);

        return $response->setContent($content);
    }
}
