<?php

class MesicCreator
{

    private function prvni_den($mesic, $rok)
    {
        $den_v_tydnu = date('N', strtotime("$rok-$mesic-01"));
        if ($den_v_tydnu == 1) $den_v_tydnu = 8;
        return $den_v_tydnu - 1;
    }

    public function pocet_dnu_v_mesici($mesic, $rok)
    {
        return date('t', strtotime("$rok-$mesic-01"));
    }

    public function createMesic($mesic, $rok)
    {
        $prvni_den = $this->prvni_den($mesic, $rok);
        $tydny = array();
        $cislo_tydne = date('W', strtotime("$rok-$mesic-01"));
        if($prvni_den==7)$tydny[$cislo_tydne]=array();
         else $tydny[$cislo_tydne] = array_pad(array(), $prvni_den, null);
        $i = 1;
        $pocet_dnu = count($tydny[$cislo_tydne]);
        while ($i <= $this->pocet_dnu_v_mesici($mesic, $rok))
        {
            if ($pocet_dnu >= 7)
            {
                $cislo_tydne++;
                $pocet_dnu = 0;
            }
            $tydny[$cislo_tydne][] = $i;
            $pocet_dnu++;
            $i++;
        }
        $tydny[$cislo_tydne] = array_pad($tydny[$cislo_tydne], 7, null);
        return $tydny;
    }

}

?>