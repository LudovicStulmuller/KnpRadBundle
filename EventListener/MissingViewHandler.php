<?php

namespace Knp\RadBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class MissingViewHandler
{
    public function handleMissingView(GetResponseEvent $event, $viewName, array $viewParams = null)
    {
        $kernel = $event->getKernel();
        $request = $event->getRequest();

        $subRequest = $request->duplicate(array(), null, array(
            '_controller' => 'KnpRadBundle:Assistant:missingView',
            'viewName'   => $viewName,
            'viewParams' => $viewParams,
        ));

        $response = $kernel->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
        $event->setResponse($response);
    }
}
