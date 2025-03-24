<?php

namespace App\Controller;

use App\ApiResource\OperationRequest;
use App\Enum\TipoOperazione;
use App\Service\MoneyService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class OperationController {

    public function __invoke(OperationRequest $data, MoneyService $moneyService): JsonResponse
    {

        if (!$data->getP1() || !$data->getP2()) {
            return new JsonResponse("Parametri mancanti");
        }

        if (!$data->getOp()) {
            return new JsonResponse("Operatore mancante");
        }

        try {
            switch ($data->getOp()){
                case TipoOperazione::SOMMA:
                    $result = $moneyService->somma($data->getP1(), $data->getP2());
                    break;
                case TipoOperazione::SOTTRAZIONE:
                    $result = $moneyService->sottrai($data->getP1(), $data->getP2());
                    break;
                case TipoOperazione::MOLTIPLICAZIONE:
                    $result = $moneyService->moltiplica($data->getP1(), $data->getP2());
                    break;
                case TipoOperazione::DIVISIONE:
                    $result = $moneyService->dividi($data->getP1(), $data->getP2());
                    break;
                default:
                    break;
            }
            return new JsonResponse($result);
        } catch (\Throwable) {
            return new JsonResponse("Hai inserito valori non validi");
        }
    }
}
