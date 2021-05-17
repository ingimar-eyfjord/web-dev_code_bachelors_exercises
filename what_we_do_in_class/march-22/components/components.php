<?php

function Input($name, $dataset, $classes, $functions, $label, $id, $type){
    function i($array){
    return implode(" ", $array);
    }
    return '
    <div class="inputParent">
    <label class="animatedLabel" for="'. $id.'">'.$label.'</label>
    <div class="inputDiv">
    <input id='.$id.' name='.$name.' class='.$classes.' type='.$type.' '.i($functions).' '.i($dataset).' >
    </div>
    </div>
    ';
};

?>