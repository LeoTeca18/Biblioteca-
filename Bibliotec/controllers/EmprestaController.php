<?php 

class EmprestaController extends RenderViews {
    public function teste () {

    echo "hhhhh";
}

    public function emprestimo()
    {
        $this->loadView('emprestimo', []);
    }

} 