<?php

namespace App\Enums;

class ResponseMessage
{
    const API_SUCCESS = 'success';
    const API_FAILED = 'fail';
    const API_ERROR = 'error';
    const API_DELETED = 'archive';

    // const AUTH = [
    //     'no_user_email' => "There is no user with this email address.",
    //     'password_changed' => "Password has been successfully changed."
    // ];

    // const BUSINESS = [
    //     'validations' => [
    //         'business_name' => "The business name field is required.",
    //         'business_address' => "The business address field is required.",
    //         'status' => "The status must be an integer."
    //     ],
    //     'create' => "Business Location Successfully Created!"
    // ];

    // const LOCATIONS = [
    //     'validations' => [
    //         'name' =>  "The name field is required.",
    //         'city' => "The city field is required.",
    //         'state_name' => "The state name field is required.",
    //         'timezone' => "The timezone field is required.",
    //         'business_id' => "The business id field is required.",
    //         'status' => "The status must be an integer."
    //     ],
    //     'create' => "Location Successfully Created!",
    // ];

    // const CLIENT = [
    //     'validations' => [
    //         'first_name' => "The first name field is required.",
    //         'last_name' => "The last name field is required."
    //     ],
    //     'create' => "Client Successfully Created!",
    //     'no_client' => "There is no existing client with this ID."
    // ];

    // const SCHEDULE = [
    //     'msg' => "Schedule successfully",
    // ];

    // const TASK = [
    //     'msg' => "Task successfully",
    // ];

    // const FORM_TEMPLATE = [
    //     'msg' => "Form template successfully",
    // ];

    // const FIELD_OPTION = [
    //     'msg' => "Field option successfully",
    // ];

    // const ORGANIZATION = [
    //     'msg' => "Organization successfully",
    // ];

    // const NOTE = [
    //     'msg' => "Note successfully",
    // ];

    // const STATUS = [
    //     'created' => "created.",
    //     'updated' => "updated.",
    //     'archived' => "archived.",
    // ];

    // const PRIMARY_THERAPIST = [
    //     'msg' => "Set Primary Therapist successfully"
    // ];

    // const DESTROY = [
    //     'reschedule' => 'Successfully rescheduled.',
    //     'signature' => 'Successfully added signature.',
    //     'destroyed' => 'Successfully destroyed orders.',
    // ];

    // const MED_LOG = [
    //     'reaction' => 'Successfully added reaction.',
    // ];
}