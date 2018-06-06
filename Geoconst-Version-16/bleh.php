   
<?
   function validateDate($date, $format = 'Y-m-d H:i:s')
                      {
                          $d = DateTime::createFromFormat($format, $date);
                          return $d && $d->format($format) == $date;

                          //Examples
                          //var_dump(validateDate('2012-02-28 12:12:12')); # true
                          //var_dump(validateDate('2012-02-30 12:12:12')); # false
                          //var_dump(validateDate('2012-02-28', 'Y-m-d')); # true
                          //var_dump(validateDate('28/02/2012', 'd/m/Y')); # true
                          //var_dump(validateDate('30/02/2012', 'd/m/Y')); # false
                          //var_dump(validateDate('14:50', 'H:i')); # true
                          //var_dump(validateDate('14:77', 'H:i')); # false
                          //var_dump(validateDate(14, 'H')); # true
                          //var_dump(validateDate('14', 'H')); # true
                         }
                         //Funcion para obtener la fecha actual
                        function Obtenerdate()
                        {
                         date_default_timezone_set('America/Los_Angeles');
                         $dates = date('y/m/d ', time());
                         return $dates;
                        }
                        function ordenaFecha{
                          //Areglamos string de Fecha para poder usarlo
                        $sub = substr($fecha, 0,4);
                        $sub2= substr($fecha, 5,2);
                        $sub3= substr($fecha, -2);
                        //Agregamos a un nuevo string bien acomodad
                        $fechafinal = $sub3.'/'.$sub2.'/'.$sub;
                        return ($fechafinal);
                        }

                        ?>