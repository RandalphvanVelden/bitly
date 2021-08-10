<?php
class GroupChoice 
{
    public $groups;
    public $group;
    
  public function __construct($groups, $group){
   $this->groups = $groups; 
    
  }

  public function groupChoice(){
?>
    <div class="group-choice"> 
        <form  action="" method="post">
            <select name="var" onchange="this.form.submit();">
<?php           
                foreach($this->groups['groups'] as $this->group){
                    $this->group = $this->group['guid'];?>
                <option value="<?php $this->group ?>"><?php echo $this->group ?></option>                
<?php   
                }
?>
            </select>
        </form> 
    </div>
<?php
    }
}
?>