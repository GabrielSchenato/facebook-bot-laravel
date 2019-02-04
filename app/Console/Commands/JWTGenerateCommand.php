<?php

namespace FacebookBot\Console\Commands;

use \Tymon\JWTAuth\Commands\JWTGenerateCommand as Command;

/**
 * Class Wrapper para sobrescrever o erro gerado no momento de executar o comando jwt:generate
 * @link https://github.com/tymondesigns/jwt-auth/issues/1298
 *
 * Class JWTGenerateCommand
 * @author David Pereira
 * @package FacebookBot\Console\Commands
 */
class JWTGenerateCommand extends Command
{

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Metodo chamado pelo framework no momento da execucao do comando
     */
    public function handle()
    {
        $this->fire();
    }

}
