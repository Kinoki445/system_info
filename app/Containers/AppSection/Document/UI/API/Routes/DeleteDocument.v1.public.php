<?php

/**
 * @apiGroup           Document
 * @apiName            DeleteDocument
 *
 * @api                {DELETE} /v1/documents/:id Delete Document
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

use App\Containers\AppSection\Document\UI\API\Controllers\DeleteDocumentController;
use Illuminate\Support\Facades\Route;

Route::delete('documents/{id}', DeleteDocumentController::class)
    ->middleware(['auth:api']);

