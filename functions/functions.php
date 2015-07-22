<?php

// Formata data aaaa-mm-dd para dd/mm/aaaa
function databr($datasql) {
    if (!empty($datasql)) {
        $p_dt = explode('-', $datasql);
        $data_br = $p_dt[2] . '/' . $p_dt[1] . '/' . $p_dt[0];
        return print $data_br;
    }
}

// Formata data dd/mm/aaaa para aaaa-mm-dd
function datasql($databr) {
    if (!empty($databr)) {
        $p_dt = explode('/', $databr);
        $data_sql = $p_dt[2] . '-' . $p_dt[1] . '-' . $p_dt[0];
        return $data_sql;
    }
}

// Formata dateTime aaaa-mm-dd hh:ii:ss para dd/mm/aaaa hh:ii:ss
function dateTimebr($dateTimeSql) {
    if (!empty($dateTimeSql)) {
        $dateTimeSeparado = explode(' ', $dateTimeSql);
        $p_dt = explode('-', $dateTimeSeparado[0]);
        $dateTime_br = $p_dt[2] . '/' . $p_dt[1] . '/' . $p_dt[0] . ' ' . $dateTimeSeparado[1];
        return print $dateTime_br;
    }
}

// Formata data dd/mm/aaaa hh:ii:ss  para aaaa-mm-dd hh:ii:ss
function dateTimesql($dateTimeBr) {
    if (!empty($dateTimeBr)) {
        $dateTimeSeparado = explode(' ', $dateTimeBr);
        $p_dt = explode('/', $dateTimeSeparado[0]);
        $dateTime_sql = $p_dt[2] . '-' . $p_dt[1] . '-' . $p_dt[0] . ' ' . $dateTimeSeparado[1];
        return $dateTime_sql;
    }
}
