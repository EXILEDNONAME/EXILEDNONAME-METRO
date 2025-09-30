<?php

namespace App\Traits;

trait HandlesFormRequest
{

    public function callAction($method, $parameters)
    {
        $request = collect($parameters)->first(fn($p) => $p instanceof \App\Http\Requests\BaseFormRequest);

        if ($request && method_exists($request, 'persist')) {
            return $request->persist();
        }

        if (method_exists(get_parent_class($this), 'callAction')) {
            return parent::callAction($method, $parameters);
        }

        return $this->$method(...array_values($parameters));
    }
}
