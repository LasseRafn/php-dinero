<?php

namespace LasseRafn\Dinero\Exceptions;

use GuzzleHttp\Exception\ClientException;

class DineroRequestException extends ClientException
{
    public function __construct(ClientException $clientException)
    {
        $message = $clientException->getMessage();

        if ($clientException->hasResponse()) {
            $messageResponse = json_decode($clientException->getResponse()
                                                            ->getBody()
                                                            ->getContents());

            $message = "$messageResponse->message:";

            if (isset($messageResponse->validationErrors)) {
                foreach ($messageResponse->validationErrors as $key => $validationError) {
                    $message .= "{$key}: {$validationError}\n";
                }
            }

            if (isset($messageResponse->languageSpecificMessages)) {
                foreach ($messageResponse->languageSpecificMessages as $error) {
                    $message .= "{$error->property}: {$error->message}\n";
                }
            }
        }

        $request = $clientException->getRequest();
        $response = $clientException->getResponse();
        $previous = $clientException->getPrevious();
        $handlerContext = $clientException->getHandlerContext();

        parent::__construct($message, $request, $response, $previous, $handlerContext);
    }
}
