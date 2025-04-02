
<{if !empty($form)}>
    <{$form|default:false}>
<{/if}>
<{if $result|default:''}>
    <{$result|default:false}>
<{/if}>
<{if !empty($error)}>
    <div class="errorMsg"><strong><{$error|default:false}></strong></div>
<{/if}>
