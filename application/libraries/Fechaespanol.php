<?php 

defined('BASEPATH') OR exit('No estan permitidos los scripts directos');


  class Fechaespanol {
 

    public function __construct() {
        $this->ci = &get_instance();
        $this->day_name = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
        $this->month_name = array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
        date_default_timezone_set("America/Lima");

    }
        /********fecha */

        public function fecha($time = null){
            $time = ($time)? $time : time();
            $fecha = getdate($time);
        return $fecha['mday'].'/'.$fecha['mon'].'/'.$fecha['year'];
        }

        public function getDate($time = null){
            $time = ($time)? $time : time();
        return date('Y-m-d',$time);
        }

        private function getTime($time = null){
            $time = ($time)? $time : time();
        return date('g:i:s a',$time);
        }

        /*
        returns a value that match with mysql datetime type cell
        */
        public function dateTime($time = null){
            var_dump($time);
            $time = ($time)? $time : time();
        return date('Y-m-d H:i:s',$time);
        }

        public function obtenerfecha($time = null){
            $time = ($time)? $time : time();
        return date('d-m-Y',$time);
        }
        /*
        fecha amigable
        */
        public function dateFriendly($time){
            $time = ($time)? $time : time();
            $dia_semana = $this->day_name[$this->getWeekDay($time)];
            $mes = $this->month_name[$this->getMonth($time)];
            $dia_mes = $this->getDay($time);
            $year = $this->getYear($time);
        return "{$dia_semana}, {$dia_mes} de {$mes} del {$year}";
        }

        public function fecha_solicitud($time){
            $time = ($time)? $time : time();
            $dia_semana = $this->day_name[$this->getWeekDay($time)];
            $mes = $this->month_name[$this->getMonth($time)];
            $dia_mes = $this->getDay($time);
            $year = $this->getYear($time);
        return "Lima, {$dia_semana} {$dia_mes} de {$mes} del {$year}";
        }

        public function fecha_pdf($time){
            $time = ($time)? $time : time();
            $dia_semana = $this->day_name[$this->getWeekDay($time)];
            $mes = $this->month_name[$this->getMonth($time)];
            $dia_mes = $this->getDay($time);
            $year = $this->getYear($time);
        return "Lima, Perú {$dia_semana} {$dia_mes} de {$mes} del {$year}";
        }

        public function datediasemana($time){
            $time = ($time)? $time : time();
            $dia_semana = $this->day_name[$this->getWeekDay($time)];
            $mes = $this->month_name[$this->getMonth($time)];
            $dia_mes = $this->getDay($time);
            $year = $this->getYear($time);
        return "{$dia_semana}";
        }

        public function datediames($time){
            $time = ($time)? $time : time();
            $dia_semana = $this->day_name[$this->getWeekDay($time)];
            $mes = $this->month_name[$this->getMonth($time)];
            $dia_mes = $this->getDay($time);
            $year = $this->getYear($time);
        return "{$dia_mes} ";
        }

        public function datemes($time){
            $time = ($time)? $time : time();
            $dia_semana = $this->day_name[$this->getWeekDay($time)];
            $mes = $this->month_name[$this->getMonth($time)];
            $dia_mes = $this->getDay($time);
            $year = $this->getYear($time);
        return "{$mes}";
        }


        public function dateano($time){
            $time = ($time)? $time : time();
            $dia_semana = $this->day_name[$this->getWeekDay($time)];
            $mes = $this->month_name[$this->getMonth($time)];
            $dia_mes = $this->getDay($time);
            $year = $this->getYear($time);
        return "{$year}";
        }

        /*
        fecha y hora amigable
        */
        public function datetimeFriendly($time = null){
            $time = ($time)? $time : time();
            $dia_semana = $this->day_name[$this->getWeekDay($time)];
            $mes = $this->month_name[$this->getMonth($time)];
            $dia_mes = $this->getDay($time);
            $year = $this->getYear($time);
            $hora = $this->getTime($time);
        return "{$dia_semana}, {$dia_mes} de {$mes} de {$year} a las {$hora}";
        }

        public function timeFriendly($time = null){
            $time = ($time)? $time : time();
            $dia_semana = $this->day_name[$this->getWeekDay($time)];
            $mes = $this->month_name[$this->getMonth($time)];
            $dia_mes = $this->getDay($time);
            $year = $this->getYear($time);
            $hora = $this->getTime($time);
        return "a las {$hora}";
        }

        public function getDay($time){
            $time = ($time)? $time : time();
            $dia = getdate($time);
        return $dia['mday']; /* 0-6*/
        }	

        public function getHour(){
        return (int)date('H'); /*formato de 24 horas*/
        }

        public function getMinute(){
        return (int)date('i'); /*00-59*/
        }

        public function getWeekDay($time){
            $time = ($time)? $time : time();

            $dia = getdate($time);
        return $dia['wday'];
        }

        public function getMonth($time = null){
            $time = ($time)? $time : time();
            $mes = getdate($time);
        return $mes['mon'];
        }

        public function getYear($time){
            $time = ($time)? $time : time();
            $ano = getdate($time);
        return $ano['year'];
        }

        public function pastTime($elapsed){
            return ($elapsed <= time())? true : false;
        }

        public function inTimeSec($intervalo){
            return time()+$intervalo;
        }

        public function inTimeMin($intervalo){
            return $this->inTimeSec($intervalo*SECOND_MINUTE);
        }

        public function inTimeHour($intervalo){
            return $this->inTimeMin($intervalo*MINUTE_HOUR);
        }

        public function inTimeDay($intervalo){
            return $this->inTimeHour($intervalo*HOUR_DAY);
        }

        public function inTimeWeek($intervalo){
            return $this->inTimeDay($intervalo*DAY_WEEK);
        }

        public function chekTime($min){
            return (time() > $this->inTimeMin($min))? true : false;
        }

        /************termino de fecha */
  }
?>
