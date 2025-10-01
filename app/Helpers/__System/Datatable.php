<?php

use \Illuminate\Support\Facades\DB;

function DatatableGenerals(?string $search = null)
{
  $data = DB::table('system_application_table_generals')->select('id', 'name')->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))->where('active', 1)->orderBy('name')->limit(50)->get()->map(fn($item) => ['id' => $item->id, 'text' => $item->name]);
  return $data;
}

function filter_DatatableGenerals()
{
  $items = DB::table('system_application_table_generals')->orderBy('name', 'asc')->pluck('name', 'name')->toArray();
  return $items;
}
