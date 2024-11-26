<?php

/**
 * @apiGroup           Document
 * @apiName            CreateDocument
 *
 * @api                {POST} /v1/documents Create Document
 * @apiDescription     Endpoint description here...
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => '', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} parameters here...
 *
 * @apiSuccessExample  {json} Success-Response:
 * HTTP/1.1 200 OK
 * {
 *     // Insert the response of the request here...
 * }
 */

use App\Containers\AppSection\Document\UI\API\Controllers\CreateDocumentController;
use Illuminate\Support\Facades\Route;

Route::post('documents', CreateDocumentController::class)
    ->middleware(['auth:api']);

