<?php 
if (!isset($ruta)) 
{
    header('location: ../');
}
else
{    
    if (isset($_SESSION['TOKEN'])) 
    {
        if ( !isset($_SESSION['codigo']) || !isset($_SESSION['tipo']) ) 
        {       
            if(isset($_SESSION['fallo']))
            {            
                if($_SESSION['fallo']=='fallo')
                {
                    header('location: '.$ruta);
                }
                elseif($_SESSION['fallo']=='falloClave')
                {
                    header('location: '.$ruta);
                }
            }
        }
    }
    else
    {
        header('location: '.$ruta);
    }
}
?>