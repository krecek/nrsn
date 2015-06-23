<?php

class KalendarControll extends BaseControl
{

    public $currentDay;
    public $mesic;
    public $rok;

    /** @var SpravceAkci */
    public $spravceAkci;

//    public $akceRepository;

    public function __construct(SpravceAkci $spravceAkci)
    {
        parent::__construct();
//        $this->akceRepository = $akceRepository;
        $this->mesic = date('m');
        $this->rok = date('Y');
        $this->currentDay = date('j');
        $this->spravceAkci = $spravceAkci;
    }

    public function handleChange($mesic, $rok)
    {
        $this->mesic = $mesic;
        $this->rok = $rok;
        $this->invalidateControl();
    }

    public function render()
    {
        $this->template->setFile(dirname(__FILE__) . '/kalendar.latte');
        $this->template->rok = $this->rok;
        $this->template->akce = $this->getAkce();
        $this->template->mesic = $this->createKalendar();
        $this->template->mesic_text = $this->prelozMesic($this->mesic);
        $this->template->currentDay = $this->currentDay;
        $this->template->nextMonth = $this->nextMonth();
        $this->template->lastMonth = $this->lastMonth();
        $this->template->month = $this->mesic; 
        
        $this->template->render();
    }

    public function getAkce()
    {
        $akce_result=array();
        $akce_tmp = $this->spravceAkci->findByDatum($this->rok . "-" . $this->mesic . "-01 +1 month", $this->rok . "-" . $this->mesic . "-01");
        foreach ($akce_tmp as $id => $akce)
        {
           if($akce->od==$akce->do)$akce_result[$akce->od->format('j')][] = $akce;
            else
            {
                if($akce->do->format('n')>$this->mesic || $akce->do->format('Y')>$this->rok) $akce->do->setDate($this->rok, $this->mesic, date('t', strtotime($this->rok.'-'.$this->mesic.'-01')));
                if($akce->od->format('n')<$this->mesic) $akce->od->setDate($this->rok, $this->mesic, 1);
                if($akce->od->format('n')==$this->mesic && $akce->do->format('n')==$this->mesic)
                {
                    for($i=$akce->od->format('j');$i<=$akce->do->format('j');$i++)
                    {
                        $akce_result[$i][] = $akce;
                    }
                }

            }
         
        }
        return $akce_result;
    }

    public function createKalendar()
    {
        $mesicCreator = new MesicCreator();
        $mesic = $mesicCreator->createMesic($this->mesic, $this->rok);
        return $mesic;
    }

    private function prelozMesic($mesic)
    {
        $preklady = array('01' => 'Leden', '02' => 'Únor', '03' => 'Březen', '04' => 'Duben', '05' => 'Květen', '06' => 'Červen',
            '07' => 'Červenec', '08' => 'Srpen', '09' => 'Záři', '10' => 'Říjen', '11' => 'Listopad', '12' => 'Prosinec');
        if (isset($preklady[$mesic])) return $preklady[$mesic];
        return $mesic;
    }

    private function prelozDen($den)
    {
        $preklady = array('Po', 'Út', 'St', 'Čt', 'Pá', 'So', 'Ne');
        if (isset($preklady[$den])) return $preklady[$den];
        else return $den;
    }

    private function nextMonth()
    {
        $return['rok'] = date('Y', strtotime($this->rok . '-' . $this->mesic . '-01 +1 month'));
        $return['mesic'] = date('m', strtotime($this->rok . '-' . $this->mesic . '-01 +1 month'));
        return $return;
    }

    private function lastMonth()
    {
        $return['rok'] = date('Y', strtotime($this->rok . '-' . $this->mesic . '-01 -1 month'));
        $return['mesic'] = date('m', strtotime($this->rok . '-' . $this->mesic . '-01 -1 month'));
        return $return;
    }

}

?>
