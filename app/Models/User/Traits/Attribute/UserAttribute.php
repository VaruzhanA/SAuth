<?php

namespace App\Models\User\Traits\Attribute;

/**
 * Class UserAttribute.
 */
trait UserAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if ($this->id != app('access')->id()) {
            return '<a href="' . route('admin.user.edit', $this) . '" class="btn btn-xs btn-primary"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit Role"></i></a> ';
        }
    }

    /**
     * @return string
     */
    public function getStatusButtonAttribute()
    {
        if ($this->id != app('access')->id()) {
            switch ($this->status) {
                case 2:
                    return '<a href="'.route('admin.user.mark', [
                        $this,
                        1,
                    ]).'" class="btn btn-xs btn-success"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="Activate"></i></a>';
                // No break

                case 1:
                    return '<a href="'.route('admin.user.mark', [
                        $this,
                        2,
                    ]).'" class="btn btn-xs btn-warning"><i class="fa fa-pause" data-toggle="tooltip" data-placement="top" title="Deactivate"></i></a>';
                // No break

                default:
                    return '';
                // No break
            }
        }

        return '';
    }

    /**
     * @return string
     */
    public function getLoginAsButtonAttribute()
    {
        /*
         * If the admin is currently NOT spoofing a user
         */
        if (! session()->has('admin_user_id') || ! session()->has('temp_user_id')) {
            //Won't break, but don't let them "Login As" themselves
            if ($this->id != app('access')->id()) {
                return '<a href="'.route('admin.user.login-as',
                    $this).'" class="btn btn-xs btn-success"><i class="fa fa-lock" data-toggle="tooltip" data-placement="top" title="Login Us'. $this->name.'"></i></a>';
            }
        }

        return '';
    }


    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return
            $this->getEditButtonAttribute().
            $this->getLoginAsButtonAttribute().
            $this->getStatusButtonAttribute();
    }
}
