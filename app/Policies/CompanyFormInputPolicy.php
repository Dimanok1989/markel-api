<?php

namespace App\Policies;

use App\Models\CompanyForm;
use App\Models\CompanyFormInput;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyFormInputPolicy
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
        return $user->getPermits('company_access_owner')->get('company_access_owner');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CompanyFormInput  $input
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, CompanyFormInput $input)
    {
        if (optional($input->form->company)->user_id === $user->id) {
            return true;
        }

        return $user->getPermits('company_access_owner')->get('company_access_owner');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        $permits = $user->getPermits('company_access_owner', 'company_form_input_create');

        return $permits->get('company_access_owner') and $permits->get('company_form_input_create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CompanyFormInput  $companyFormInput
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, CompanyFormInput $input)
    {
        if (optional($input->form->company)->user_id === $user->id) {
            return true;
        }

        $permits = $user->getPermits('company_access_owner', 'company_form_input_edit');

        return $permits->get('company_access_owner') and $permits->get('company_form_input_edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CompanyFormInput  $input
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, CompanyFormInput $input)
    {
        if (optional($input->form->company)->user_id === $user->id) {
            return true;
        }

        $permits = $user->getPermits('company_access_owner', 'company_form_input_delete');

        return $permits->get('company_access_owner') and $permits->get('company_form_input_delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CompanyFormInput  $companyFormInput
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, CompanyFormInput $companyFormInput)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CompanyFormInput  $companyFormInput
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, CompanyFormInput $companyFormInput)
    {
        //
    }
}
