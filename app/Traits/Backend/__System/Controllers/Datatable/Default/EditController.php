<?php

namespace App\Traits\Backend\__System\Controllers\Datatable\Default;

trait EditController
{
    public function edit($id)
    {
        $data = $this->model::findOrFail($id);
        $model = $this->model;
        $path = $this->path;
        $statusName = $this->status;
        $url = $this->url;
        return view($this->path . 'edit', compact('data', 'model', 'path', 'statusName', 'url'));
    }
}
