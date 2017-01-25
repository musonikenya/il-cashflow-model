<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Cashflow\Computecashflowmodel;
use App\Cashflow\Generatefinancialsummary;
use App\Cashflow\CashflowUploadData;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $generatefinancialsummary;
    protected $newCashflowModel;
    protected $processCashflowUploads;
    protected $notificationId;
    protected $updateNotificationId;

    public function __construct()
    {
        $this->middleware('auth');
        $this->generatefinancialsummary = new Generatefinancialsummary;
        $this->newCashflowModel = new Computecashflowmodel;
        $this->processCashflowUploads = new CashflowUploadData;
        $this->notificationId = NULL;
        $this->updateNotificationId = NULL;
    }
}
