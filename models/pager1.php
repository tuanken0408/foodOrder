<?php
class pagination{
	private $_tongsoItem;
	private $_item1Page;
	private $_pageHienthi;
	private $_tongsoPage;
	private $_pageHientai;

	public function __construct($tongsoItem,$pageHientai=1,$item1Page=5,$pageHienthi= 5){
		$this->_tongsoItem = $tongsoItem;
		$this->_item1Page = $item1Page;
		if ($pageHienthi%2==0) {
			$pageHienthi = $pageHienthi +1;
		}
		$this->_pageHienthi = $pageHienthi;
		$this->_pageHientai  = $pageHientai;
		$this->_tongsoPage = ceil($tongsoItem/$item1Page);
	}
	public function get_pageHienthi(){
		return $this->_pageHienthi;
	}
	public function get_pageHientai(){
		return $this->_pageHientai;
	}
	public function showPagination(){

		$paginationHTML  = '';
		if ($this->_tongsoPage>1) {
			$link_hientai = (isset($_SERVER['HTTPS'])?"https":"http")."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			if (isset($_GET['page'])){
			    if ((int)($_GET['page'])>=10){
			        $link_hientai = substr($link_hientai,0,-8);
                }
                else{
			        $link_hientai = substr($link_hientai,0,-7);
                }
            }
            $start = '';
			$prev = '';
			if($this->_pageHientai>1){
			    $start = "<li><a href='$link_hientai&page=1'>Start</a></li>";
			    $prev  = "<li><a href='$link_hientai&page=".($this->_pageHientai-1)."'><</a>";
            }
            $next ='';
			$end = '';
			if($this->_pageHientai< $this->_tongsoPage){
			    $next = "<li><a href='$link_hientai&page=".($this->_pageHientai+1)."'>></a></li>";
			    $end = "<li><a href='$link_hientai&page=".($this->_tongsoPage)."'>End</a></li>";
            }
            if ($this->_pageHienthi<$this->_tongsoPage){
			    if ($this->_pageHientai==1){
			        $page_start = 1;
			        $page_end = $this->_pageHienthi;
                }else if ($this->_pageHientai == $this->_tongsoPage){
			        $page_start = $this->_tongsoPage - $this->_pageHienthi +1;
			        $page_end = $this->_tongsoPage;
                }else{
                    $page_start = $this->_pageHientai - ($this->_pageHienthi-1)/2;
                    $page_end = $this->_pageHientai + ($this->_pageHienthi-1)/2;
                    if ($page_start<1){
                        $page_end = $page_end +1;
                        $page_start =1 ;
                    }
                    if ($page_end>$this->_tongsoPage){
                        $page_end = $this->_tongsoPage;
                        $page_start = $page_end - $this->_pageHienthi+1;
                    }
                }
            }else{
                $page_start =1;
                $page_end = $this->_tongsoPage;
            }
            $listPages ='';
            for ($i = $page_start;$i<=$page_end;$i++){
                if ($i== $this->_pageHientai){
                    $listPages .="<li class='active'><a href='#'>".$i.'</a>';
                }else{
                    $listPages .="<li><a href='$link_hientai&page=".$i."'>".$i.'</a>';
                }
            }
        $paginationHTML = '<ul class="pagination">'.$start.$prev.$listPages.$next.$end.'</ul>';
		}
		return $paginationHTML;
	}

}
?>