<?php

namespace App\Traits\Backend\__System\Controllers\Datatable\Extension;

use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Models\Activity;

trait ChartController
{
    public function chart()
    {
        for ($i = 1; $i <= 12; $i++) {
            if (\Carbon\Carbon::now()->format('m')) {
                Cache::forget('activity_created_' . \Carbon\Carbon::now()->format('m'));
                Cache::forget('activity_updated_' . \Carbon\Carbon::now()->format('m'));
                Cache::forget('activity_deleted_' . \Carbon\Carbon::now()->format('m'));
            }
        }

        $created = [
            Cache::remember('activity_created_01', 3600, function () {
                return Activity::where('description', 'created')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-01%')->count();
            }),
            Cache::remember('activity_created_02', 3600, function () {
                return Activity::where('description', 'created')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-02%')->count();
            }),
            Cache::remember('activity_created_03', 3600, function () {
                return Activity::where('description', 'created')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-03%')->count();
            }),
            Cache::remember('activity_created_04', 3600, function () {
                return Activity::where('description', 'created')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-04%')->count();
            }),
            Cache::remember('activity_created_05', 3600, function () {
                return Activity::where('description', 'created')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-05%')->count();
            }),
            Cache::remember('activity_created_06', 3600, function () {
                return Activity::where('description', 'created')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-06%')->count();
            }),
            Cache::remember('activity_created_07', 3600, function () {
                return Activity::where('description', 'created')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-07%')->count();
            }),
            Cache::remember('activity_created_08', 3600, function () {
                return Activity::where('description', 'created')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-08%')->count();
            }),
            Cache::remember('activity_created_09', 3600, function () {
                return Activity::where('description', 'created')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-09%')->count();
            }),
            Cache::remember('activity_created_10', 3600, function () {
                return Activity::where('description', 'created')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-10%')->count();
            }),
            Cache::remember('activity_created_11', 3600, function () {
                return Activity::where('description', 'created')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-11%')->count();
            }),
            Cache::remember('activity_created_12', 3600, function () {
                return Activity::where('description', 'created')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-12%')->count();
            }),
        ];

        $updated = [
            Cache::remember('activity_updated_01', 3600, function () {
                return Activity::where('description', 'updated')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-01%')->count();
            }),
            Cache::remember('activity_updated_02', 3600, function () {
                return Activity::where('description', 'updated')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-02%')->count();
            }),
            Cache::remember('activity_updated_03', 3600, function () {
                return Activity::where('description', 'updated')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-03%')->count();
            }),
            Cache::remember('activity_updated_04', 3600, function () {
                return Activity::where('description', 'updated')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-04%')->count();
            }),
            Cache::remember('activity_updated_05', 3600, function () {
                return Activity::where('description', 'updated')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-05%')->count();
            }),
            Cache::remember('activity_updated_06', 3600, function () {
                return Activity::where('description', 'updated')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-06%')->count();
            }),
            Cache::remember('activity_updated_07', 3600, function () {
                return Activity::where('description', 'updated')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-07%')->count();
            }),
            Cache::remember('activity_updated_08', 3600, function () {
                return Activity::where('description', 'updated')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-08%')->count();
            }),
            Cache::remember('activity_updated_09', 3600, function () {
                return Activity::where('description', 'updated')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-09%')->count();
            }),
            Cache::remember('activity_updated_10', 3600, function () {
                return Activity::where('description', 'updated')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-10%')->count();
            }),
            Cache::remember('activity_updated_11', 3600, function () {
                return Activity::where('description', 'updated')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-11%')->count();
            }),
            Cache::remember('activity_updated_12', 3600, function () {
                return Activity::where('description', 'updated')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-12%')->count();
            }),
        ];

        $deleted = [
            Cache::remember('activity_deleted_01', 3600, function () {
                return Activity::where('description', 'deleted')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-01%')->count();
            }),
            Cache::remember('activity_deleted_02', 3600, function () {
                return Activity::where('description', 'deleted')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-02%')->count();
            }),
            Cache::remember('activity_deleted_03', 3600, function () {
                return Activity::where('description', 'deleted')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-03%')->count();
            }),
            Cache::remember('activity_deleted_04', 3600, function () {
                return Activity::where('description', 'deleted')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-04%')->count();
            }),
            Cache::remember('activity_deleted_05', 3600, function () {
                return Activity::where('description', 'deleted')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-05%')->count();
            }),
            Cache::remember('activity_deleted_06', 3600, function () {
                return Activity::where('description', 'deleted')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-06%')->count();
            }),
            Cache::remember('activity_deleted_07', 3600, function () {
                return Activity::where('description', 'deleted')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-07%')->count();
            }),
            Cache::remember('activity_deleted_08', 3600, function () {
                return Activity::where('description', 'deleted')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-08%')->count();
            }),
            Cache::remember('activity_deleted_09', 3600, function () {
                return Activity::where('description', 'deleted')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-09%')->count();
            }),
            Cache::remember('activity_deleted_10', 3600, function () {
                return Activity::where('description', 'deleted')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-10%')->count();
            }),
            Cache::remember('activity_deleted_11', 3600, function () {
                return Activity::where('description', 'deleted')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-11%')->count();
            }),
            Cache::remember('activity_deleted_12', 3600, function () {
                return Activity::where('description', 'deleted')->where('subject_type', $this->model)->where('created_at', 'like', \Carbon\Carbon::now()->format('Y') . '-12%')->count();
            }),
        ];

        return response()->json(['created' => $created, 'updated' => $updated, 'deleted' => $deleted]);
    }
}
