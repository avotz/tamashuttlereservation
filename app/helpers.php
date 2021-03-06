<?php 



function money($amount, $symbol = '$')
{
    return (!$symbol) ? number_format($amount, 2, ".", ",") : $symbol . number_format($amount, 2, ".", ",");
}
function number($amount)
{
    return preg_replace("/([^0-9\\.])/i", "", $amount);
}
function percent($amount, $symbol = '%')
{
    return $symbol . number_format($amount, 0, ".", ",");
}
function age($birthdate)
{
	return $birthdate;
}
function flash($message, $level = 'info')
{
	session()->flash('flash_message',$message);
	session()->flash('flash_message_level',$level);
}
function paginate($items, $perPage)
{
    $pageStart           = \Request::get('page', 1);
    $offSet              = ($pageStart * $perPage) - $perPage;
    $itemsForCurrentPage = array_slice($items, $offSet, $perPage, TRUE);

    return new Illuminate\Pagination\LengthAwarePaginator(
        $itemsForCurrentPage, count($items), $perPage,
        Illuminate\Pagination\Paginator::resolveCurrentPage(),
        ['path' => Illuminate\Pagination\Paginator::resolveCurrentPath()]
    );
}
/*function set_active($path, $active = 'active') {
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }*/

function set_active($path, $active = 'is-active')
{   
  
    return Request::is($path) ? $active : '';
}

 function logInfo($user,$action)
    {
        Log::info('User: '. $user->id .'-'.$user->name.', Acción: '. $action);
    }