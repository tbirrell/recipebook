<?php 

namespace App\Traits;

trait Sluggable {

	protected $separator = '-';
	protected $slugCol = 'slug';
	protected $nameCol = 'name';

	public function slugify()
  {
    $slug = trim(strip_tags($this->{$this->nameCol}));
    $slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $slug);
    $slug = strtolower(preg_replace("/[\/_|+ -]+/", $this->separator, $slug));
    $slug = trim($slug, $this->separator);
    $this->{$this->slugCol} = $slug;
    return $this;
  }

  public function uniquely()
  {
  	$this->{$this->slugCol} .= $this->separator.str_random(5);
    return $this;
  }

  public function unslugify()
  {
  	//slug to name transition 
  	return $this;
  }

}
