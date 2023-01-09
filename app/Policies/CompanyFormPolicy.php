<?php

namespace App\Policies;

use App\Models\CompanyForm;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyFormPolicy
{
    use HandlesAuthorization;

    /**
     * Выполнить предварительную авторизацию.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->isAdministrator()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CompanyForm  $companyForm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, CompanyForm $form)
    {
        if (($form->company->user_id ?? null) === $user->id) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->getPermits('company_form_create')->get('company_form_create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CompanyForm  $form
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, CompanyForm $form)
    {
        if (($form->company->user_id ?? null) === $user->id) {
            return true;
        }

        return $user->getPermits('company_form_edit')->get('company_form_edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CompanyForm  $companyForm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, CompanyForm $form)
    {
        if (($form->company->user_id ?? null) === $user->id) {
            return true;
        }

        return $user->getPermits('company_form_delete')->get('company_form_delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CompanyForm  $companyForm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, CompanyForm $companyForm)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CompanyForm  $companyForm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, CompanyForm $companyForm)
    {
        //
    }
}
