<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| custom pagination
| -------------------------------------------------------------------------
|
*/

        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = true;
        
		$config['full_tag_open'] = '<div class="paginate col-sm-12 text-center"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div>';

		$config['first_link'] = '<i class="fa fa-fw fa-angle-double-left" title="Go to first page"></i>';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = '<i class="fa fa-fw fa-angle-double-right" title="Go to last page"></i>';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '<i class="fa fa-fw fa-angle-right" title="Next page"></i>';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '<i class="fa fa-fw fa-angle-left" title="Previous page"></i>';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
        $config['num_links'] = 5;


/* End of file pagination.php */
/* Location: ./application/config/pagination.php */