<?php

/**
 * @apiGroup           Document
 * @apiName            ListDocuments
 *
 * @api                {GET} /v1/documents List Documents
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

use App\Containers\AppSection\Document\UI\API\Controllers\ListDocumentsController;
use Illuminate\Support\Facades\Route;

Route::get('documents', ListDocumentsController::class)
    ->middleware(['auth:api']);

