<?
class StatCalc
{
    var $pos;
    var $id;
    var $type;
    var $worth;
    var $min;
    var $max;
    var $rate;

    function StatCalc($pos, $id, $type, $worth, $min, $max, $rate) 
    {
        $this->pos = $pos;
        $this->id = $id;
        $this->type = $type;
        $this->worth = $worth;
        $this->min = $min;
        $this->max = $max;
        $this->rate = $rate;
    }

    function getPos() { return $this->pos; }
    function getID() { return $this->id; }
    function getType() { return $this->type; }
    function getWorth() { return $this->worth; }
    function getMin() { return $this->min; }
    function getMax() { return $this->max; }
    function getRate() { return $this->rate; }

    function GetObject($pos, $id) 
    {
        $retval = false;

        if ($this->pos == $pos && $this->id == $id) 
        {
            $retval = true;
        }

        return $retval;
    }

    function DoCalc($value) 
    {
        $retval = 0;

        if ($this->type == 1) 
        {
            $retval = $value * $this->worth;
        }
        else if ($this->type == 2) 
        {
            if ($this->min <= $value && $value <= $this->max) 
            {
                $retval = $this->worth;
            }
        }
        else if ($this->type == 3) 
        {
            if (($value - $this->min) > 0)
            {
                $retval = (($value - $this->min) / $this->rate + 1);
            }
        }

        return $retval;
    }

}
?>