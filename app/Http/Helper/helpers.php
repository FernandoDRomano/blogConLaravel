<?php

function current_user(){
    return auth()->user()
    ;
}

function columns_for_dashboard(){

    if(current_user()->hasPermissionTo('View Users') 
        && current_user()->hasPermissionTo('View Posts') 
        && current_user()->hasPermissionTo('View Comments')){
            return 'col-lg-4';
    }

    if((current_user()->hasPermissionTo('View Comments') 
        && current_user()->hasPermissionTo('View Users') 
        && !current_user()->hasPermissionTo('View Posts'))
        || 
        (current_user()->hasPermissionTo('View Comments') 
        && current_user()->hasPermissionTo('View Posts') 
        && !current_user()->hasPermissionTo('View Users'))){
            return 'col-lg-6';
    }

    if((current_user()->hasPermissionTo('View Posts') 
        && current_user()->hasPermissionTo('View Users') 
        && !current_user()->hasPermissionTo('View Comments'))
        || 
        (current_user()->hasPermissionTo('View Posts') 
        && current_user()->hasPermissionTo('View Comments') 
        && !current_user()->hasPermissionTo('View Users'))){
            return 'col-lg-6';
    }

    if ((current_user()->hasPermissionTo('View Users') 
        && current_user()->hasPermissionTo('View Posts') 
        && !current_user()->hasPermissionTo('View Comments'))
        || 
        (current_user()->hasPermissionTo('View Users') 
        && current_user()->hasPermissionTo('View Comments') 
        && !current_user()->hasPermissionTo('View Posts'))) {
            return 'col-lg-6';
    }
            
}   

function isActive($route){
    return request()->routeIs($route) ? 'active' : '' ;
}
