<?
if(isset($resultado) && is_array($resultado)){
    
foreach($resultado as $v){
  ?>
<div class="resultado-pesquisa">
    <div class="pesquisa-titulo"><a href="<?=site_url($v->getLink())?>"><?=$v->getTitulo()?></a></div>
    <div class="pesquisa-desc"><a href="<?=site_url($v->getLink())?>"><?=$v->getBreveDescricao()?></a></div>
</div>
      
  <?
}

}
?>