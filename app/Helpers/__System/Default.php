<?php

use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

function activities($model) {
  $data = Activity::where('subject_type', $model)->orderBy('created_at', 'desc')->get();
  return $data;
}

function ManagementRoles() {
  $items = DB::table('roles')->orderBy('created_at','asc')->where('active', 1)->pluck('name', 'id')->toArray();
  return $items;
}

function ManagementUsers() {
  $items = DB::table('users')->orderBy('created_at','asc')->where('active', 1)->pluck('name', 'id')->toArray();
  return $items;
}
