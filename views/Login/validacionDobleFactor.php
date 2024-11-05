<div id="modalValidar" class="modalCUI modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Autenticación de Doble Factor</h5>
            </div>
            <form class="formValidarUltimosDigitos" id="validarUltimosDigitosForm" action="" method="post">
                <div class="modal-body">

                    <div class="containerGuiaCUI">
                        <p>
                            Ingresa los 2 últimos dígitos de tu Número de Documento de Identidad.
                        </p>
                        <!-- <img src="<?= base_url?>/assets/dniGuiCUI.svg" alt="" srcset=""> -->
                    </div>

                    <div class="containerCUI">
                        <label for="cui" class="form-label">2 útlimos dígitos de tu Número de Documento de Identidad:</label>
                        <input type="text" id="ultimosDigitos" maxlength="2" autocomplete="off">
                    </div>
                </div>
                <div class="containerButtonsModals">
                    <input type="submit" id="btnConfirmarUltimosDigitos" class="btn btn-submit" value="Confirmar">
                    <input type="button" id="btnCancelarUltimosDigitos" class="btn btn-cancel" data-bs-dismiss="modal" value="Cancelar">
                </div>
            </form>
        </div>
    </div>
</div>