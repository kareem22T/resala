<?php

namespace App\Http\Traits;

trait DataFormController
{
  public function jsonData($status, $msg, $errors, $data)
  {
    return response()->json([
      "status" => $status,
      "message" => $msg,
      "errors" => $errors,
      "data" => $data
    ]);
  }
}
