<?php
class Model_Core_Pager
{
    public $totalRecord = 0;
    public $currentPage = 0;
    public $numberOfPage = 0;
    public $recordPerPage = 5;
    public $start = 1;
    public $previous = 0;
    public $next = 0;
    public $end = 0;
    public $startLimit = 0;
    public $recordPerPageOptions = [10,20,50,100,200];

    public function __construct()
    {
        $this->setCurrentPage();
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

   
    public function setCurrentPage()
    {
        $this->currentPage = (int)Ccc::getModel('Core_Request')->getParam('p', 1);
        return $this;
    }

    public function calculate()
    {
        $numberOfPage = ceil( $this->getTotalRecord() / $this->getRecordPerPage());
        $this->setNumberOfPage($numberOfPage);

        if ($this->getNumberOfPage() == 0) {
            $this->currentPage = 0;
        }

        if ($this->getNumberOfPage() == 1 || ($this->getNumberOfPage() > 1 && $this->currentPage <= 0)) {
            $this->currentPage = 1;
        }

        if ($this->getCurrentPage() > $this->getNumberOfPage()) {
            $this->currentPage = $this->getNumberOfPage();
        }

        $this->setStart(1);
        if (!$this->getNumberOfPage()) {
            $this->setStart(0);
        }
        if ($this->getCurrentPage() == 1) {
            $this->setStart(0);
        }

        $this->setEnd($this->getNumberOfPage());
        if ($this->getEnd() > $this->getNumberOfPage()) {
            $this->setEnd($this->getNumberOfPage());
        }

        $this->setPrevious($this->getCurrentPage()-1);
        if ($this->getCurrentPage() <= 1) {
            $this->setPrevious(0);
        }

        $this->setNext($this->getCurrentPage() + 1);
        if ($this->getCurrentPage() == $this->getNumberOfPage()) {
            $this->setNext(0);
        }

        $this->setStartLimit((($this->getCurrentPage() - 1)*($this->getRecordPerPage())));
    }
 
    public function getTotalRecord()
    {
        return $this->totalRecord;
    }

    public function setTotalRecord($totalRecord)
    {
        $this->totalRecord = $totalRecord;
        return $this;
    }

    public function getRecordPerPage()
    {
        return $this->recordPerPage;
    }

    
    public function setRecordPerPage($recordPerPage)
    {
        $this->recordPerPage = $recordPerPage;
        return $this;
    }

    
    public function getNumberOfPage()
    {
        return $this->numberPage;
    }

    
    public function setNumberOfPage($numberPage)
    {
        $this->numberPage = $numberPage;
        return $this;
    }

    
    public function getStart()
    {
        return $this->start;
    }

    
    public function setStart($start)
    {
        $this->start = $start;
        return $this;
    }

    
    public function getPrevious()
    {
        return $this->previous;
    }

    
    public function setPrevious($previous)
    {
        $this->previous = $previous;
        return $this;
    }
    
    public function getNext()
    {
        return $this->next;
    }
    
    public function setNext($next)
    {
        $this->next = $next;
        return $this;
    }
    
    public function getEnd()
    {
        return $this->end;
    }
    
    public function setEnd($end)
    {
        $this->end = $end;
        return $this;
    }
    
    public function getStartLimit()
    {
        return $this->startLimit;
    }
    
    public function setStartLimit($startLimit)
    {
        $this->startLimit = $startLimit;
        return $this;
    }

    public function getRecordPerPageOptions()
    {
        return $this->recordPerPageOptions;
    }
    
    public function setRecordPerPageOptions($recordPerPageOptions)
    {
        $this->recordPerPageOptions = $recordPerPageOptions;
        return $this;
    }
}