<?php

class MenuRepository extends Repository
{

    public function findById($id)
    {
        $by['id'] = $id;
        return $this->findBy($by)->fetch();
    }

    public function findByRubrika($id)
    {
        $by['rubrika'] = $id;
        return $this->findBy($by)->fetchPairs('poradi');
    }

    public function ulozitMenu(Menu $menu)
    {
        $puvodni_rubriky = array();
        $nove_rubriky = array();
        foreach($this->findByRubrika($menu->rubrika)as $key=>$puvodni_rubrika)
        {
            $puvodni_rubriky[] = $puvodni_rubrika['id']; 
        }
        
        foreach ($menu->getPolozky() as $polozka)
        {
            if ($polozka['id'])
            {
                $zaznam = $this->getTable()->where('id', $polozka['id'])->update($polozka);
                $nove_rubriky[]=$polozka['id'];
            }
            else
            {
                unset($polozka['id']);
                $zaznam = $this->getTable()->insert($polozka);
            }
        }
        $this->getTable()->where('id',array_diff($puvodni_rubriky, $nove_rubriky))->delete();  //vymazat zrušené rubriky
       
    }

}

?>
