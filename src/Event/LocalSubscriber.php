<?php
/**
 * Created by PhpStorm.
 * User: ravgus
 * Date: 14.02.19
 * Time: 17:39
 */

namespace App\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LocalSubscriber implements EventSubscriberInterface
{
    /**
     * @var string
     */
    private $defaultLocal;

    public function __construct($defaultLocal = 'en')
    {
        $this->defaultLocal = $defaultLocal;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [
                'onKernelRequest',
                20
            ]
        ];
    }

    public function onKernelRequest(GetResponseEvent $responseEvent)
    {
        $request = $responseEvent->getRequest();

        if (!$request->hasPreviousSession()) {
            return;
        }

        if ($locale = $request->attributes->get('_locale')) {
            $request->getSession()
                ->set('_locale', $locale);
        } else {
            $request->setLocale(
                $request->getSession()
                    ->get('_locale', $this->defaultLocal)
            );
        }
    }
}