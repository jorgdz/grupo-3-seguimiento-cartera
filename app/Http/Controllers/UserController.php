<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Admin\Role;
use App\Models\Admin\Cargo;
use App\Models\Admin\Genero;
use App\Models\Admin\Empresa;
use App\Models\Admin\Departamento;
use App\Models\Admin\CargoDepartamento;
use App\Models\Admin\DepartamentoEmpresa;
use App\Imports\ImportUsers;
use App\Imports;
use Excel;
use DateTime;
use DB;
use Illuminate\Support\Facades\Input;
class UserController extends Controller
{

    public function __construct()
	{
		$this->middleware('auth');
	} 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $users = User::with('genero')->searchWhere('cedula', 'LIKE', '%'.$request->get('search').'%')
            ->searchOrWhere('nombre1', 'LIKE', '%'.$request->get('search').'%')
            ->searchOrWhere('nombre2', 'LIKE', '%'.$request->get('search').'%')
            ->searchOrWhere('apellido_paterno', 'LIKE', '%'.$request->get('search').'%')
            ->searchOrWhere('apellido_materno', 'LIKE', '%'.$request->get('search').'%')
            ->searchOrWhere('usuario', 'LIKE', '%'.$request->get('search').'%')
    
            ->orderBy('id', 'desc')->paginate(7);

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $generos = Genero::orderBy('id', 'asc')->get();
        return view('users.create', array('generos' => $generos));
    }




    public function sanear_string($string)
    {
 
            $string = trim($string);
        
            $string = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
                array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
                $string
            );
        
            $string = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
                array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
                $string
            );
        
            $string = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
                array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
                $string
            );
        
            $string = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
                array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
                $string
            );
        
            $string = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
                array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
                $string
            );
        
            $string = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç'),
                array('n', 'N', 'c', 'C',),
                $string
            );
 
    
 
 
        return $string;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();

        $validate = \Validator::make($request->all(), [          
            'cedula' => 'required|unique:users|ecuador:ci',
            'nombre1' => 'required',
            'nombre2' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'genero_id' => 'required',
            'discapacidad' => 'required',
            'area' => 'required',
            'fecha_nacimiento' => 'required|date_format:"Y-m-d"'
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }


         /**validar que area es */
         if ($request->area==1) {
            $area = 'VENTAS';
        } 
        if ($request->area==0) {
            $area = 'COBRANZA';
        } 
        if ($request->area==2) {
            $area = 'ADMINISTRATIVO';
        } 

       

        $user->cedula = $request->cedula;
        $user->nombre1 = $request->nombre1;
        $user->nombre2 = $request->nombre2;
        $user->apellido_paterno = $request->apellido_paterno;
        $user->apellido_materno = $request->apellido_materno;
        $user->direccion = $request->direccion;
        $user->celular = $request->celular;
        $user->telefono = $request->telefono;
        $user->estado_civil = $request->estado_civil;
        $user->email = $request->email;
        $user->genero_id = $request->genero_id;
        $user->foto = 'user.png';    
        $user->discapacidad = $request->discapacidad;
        $user->comentario = $request->comentario;
        $user->extension = $request->extension;
        $user->area = $area;
        $usuariogenerado = $this->getNickname(strtolower($request->nombre1), strtolower($request->nombre2), strtolower($request->apellido_paterno), strtolower($request->apellido_materno));
        
        $user->usuario = $this->sanear_string($usuariogenerado);

        $user->password = bcrypt($request->cedula);
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->enabled = $request->enabled;
        
        if (empty($request->direccion) || empty($request->celular) || empty($request->telefono) || empty($request->estado_civil) || empty($request->email) || empty($request->genero_id) || empty($request->discapacidad) || empty($request->extension) || empty($request->fecha_nacimiento))  
        {
            $user->perfil_actualizado = false;
        }
        else
        {
            $user->perfil_actualizado = true;
        }

        /**guardar el usuario con mayusculas */
        $usuarioSII  = strtoupper($user->usuario);
        $apellidoSII1  = strtoupper($user->apellido_paterno);
        $apellidoSII2  = strtoupper($user->apellido_materno);
        $nombreSII1  = strtoupper($user->nombre1);
        $nombreSII2  = strtoupper($user->nombre2);

       

        /***
         * 
         *  INGRESAR USUARIO SII COBRANZA && VENTAS
         *  
         */
        $fecha = new DateTime();
        $fechahoy= $fecha->format('d-m-y H:i:s');
      //  DD($request->area );
        if ($request->area == 1 || $request->area == 2) { //GRUPO DE VENTAS
           
                $usersVENTAS = DB::connection('sqlsrv3')->statement
                ("
                
                
                    INSERT INTO SEG_Usuario
                    VALUES 
                    ('$usuarioSII','a0ed203a03ad601a9da7f4e8124b95f5','$nombreSII1','$apellidoSII1','$apellidoSII1  $apellidoSII2  $nombreSII1  $nombreSII2','N','','A','USER','$fechahoy','USER','$fechahoy','')
                    

                    INSERT INTO SEG_Perfil
                    SELECT '1', idUsuario , '504', usrIng ,fecIng , usrMod,fecMod   FROM SEG_Usuario 
                    WHERE NOT idUsuario IN (SELECT idUsuario FROM SEG_Perfil)
                   

                    SELECT idUsuario , '2','1', nombreCompleto , nombre , usrIng,  usrIng ,apellido , ' ', '0' , fecMod , fecMod FROM SEG_Usuario 
                    WHERE NOT idUsuario COLLATE SQL_Latin1_General_CP1_CI_AS IN (SELECT IdPersona FROM  sii_callcenter..tbPersona) AND NOT idUsuario IN ('admin','EALMEIDA','jochoa','10001',	'10002',	'10003',	'10004',	'10005',	'1003',	'20001',	'3001',	'3002',	'4000',	'42001',	'5000',	'6000',	'7000',	'70000',	'80000',	'900001',	'ADMINISTRADOR',	'AUDITOR',	'CAUDITORIA',	'DPAUDITORIA',	'DTORREST',	'EALMIEDA',	'EESMERALDAS',	'ETORRADO',	'GLEONS',	'GMUNOS',	'ICHANO',	'JGOROTIZA',	'JSANLUCAS',	'JSLUCAS',	'KAGUIRRECP',	'KCAMPOVERDE',	'KJIMENEX',	'KREYES',	'MGRANADOS',	'OPCLARO',	'OPRESCATE3',	'RCASTELL',	'RESCATE',	'SGOROTIZA',	'SPSUPERVISOR3',	'SPSUPERVISOR4',	'SPVENTA',	'TMARIDUENA ',	'VEAUDITORIA',	'VECUADOR',	'VTCLARO',	'VTCLARO2',	'VTVENTAS')


                    insert into sii_callcenter..tbPersona (IdPersona , TipoIdentificacionTabla , TipoIdentificacion , NombreLargo , Nombre ,UsuEdicion ,UsuRegistro, Apellido , DireccionPrincipal, TelefonoPrincipal,FecRegistro, FecEdicion)
                    SELECT idUsuario , '2','1', nombreCompleto , nombre , usrIng,  usrIng ,apellido , ' ', '0' , fecMod , fecMod FROM SEG_Usuario 
                    WHERE NOT idUsuario COLLATE SQL_Latin1_General_CP1_CI_AS IN (SELECT IdPersona FROM  sii_callcenter..tbPersona) AND NOT idUsuario IN ('admin','EALMEIDA','jochoa','10001',	'10002',	'10003',	'10004',	'10005',	'1003',	'20001',	'3001',	'3002',	'4000',	'42001',	'5000',	'6000',	'7000',	'70000',	'80000',	'900001',	'ADMINISTRADOR',	'AUDITOR',	'CAUDITORIA',	'DPAUDITORIA',	'DTORREST',	'EALMIEDA',	'EESMERALDAS',	'ETORRADO',	'GLEONS',	'GMUNOS',	'ICHANO',	'JGOROTIZA',	'JSANLUCAS',	'JSLUCAS',	'KAGUIRRECP',	'KCAMPOVERDE',	'KJIMENEX',	'KREYES',	'MGRANADOS',	'OPCLARO',	'OPRESCATE3',	'RCASTELL',	'RESCATE',	'SGOROTIZA',	'SPSUPERVISOR3',	'SPSUPERVISOR4',	'SPVENTA',	'TMARIDUENA ',	'VEAUDITORIA',	'VECUADOR',	'VTCLARO',	'VTCLARO2',	'VTVENTAS')
                    

                    INSERT INTO sii_callcenter..tbAgente (IdPersona , IdPersonaSupervisor , IdEstadoTabla , IdEstado  , UsuRegistro , FecRegistro , UsuEdicion , FecEdicion , Puesto , Clave , HorasTrabajo, NoGrabarLlamada, Auditor)
                    SELECT IdPersona , 'SPSUPERVISORA' , '1', 'A', UsuRegistro , FecEdicion , UsuRegistro , FecRegistro , '1' , '','8','0','0' FROM sii_callcenter..tbPersona WHERE  IdPersona collate Latin1_General_CI_AS in ( select idusuario from  SEG_Perfil where idRol = '504') AND NOT IdPersona IN (SELECT IdPersona FROM sii_callcenter..tbAgente)

                    

                    INSERT INTO sii_callcenter..tbCampañaAgente (IdCampaña , IdPersonaAgente , IDESTADOTABLA , IDESTADO )
                    select '33' , IdPersona , IdEstadoTabla , IdEstado  from sii_callcenter..tbAgente where IdPersona collate Latin1_General_CI_AS in ( select idusuario from  SEG_Perfil where idRol = '504') and not IdPersona in (select IdPersonaAgente from sii_callcenter..tbCampañaAgente where IdCampaña = '33'  )
                    

                    INSERT INTO sii_callcenter..tbCampañaAgente (IdCampaña , IdPersonaAgente , IDESTADOTABLA , IDESTADO )
                    select '49' , IdPersona , IdEstadoTabla , IdEstado  from sii_callcenter..tbAgente where IdPersona collate Latin1_General_CI_AS in ( select idusuario from  SEG_Perfil where idRol = '504') and not IdPersona in (select IdPersonaAgente from sii_callcenter..tbCampañaAgente where IdCampaña = '49' )
                    
                    INSERT INTO sii_callcenter..tbCampañaAgente (IdCampaña , IdPersonaAgente , IDESTADOTABLA , IDESTADO )
                    select '50' , IdPersona , IdEstadoTabla , IdEstado  from sii_callcenter..tbAgente where IdPersona collate Latin1_General_CI_AS in ( select idusuario from  SEG_Perfil where idRol = '504') and not IdPersona in (select IdPersonaAgente from sii_callcenter..tbCampañaAgente where IdCampaña = '50'  )
                    

                    INSERT INTO sii_callcenter..tbPuestoAgente
                    select '48', IdPersona ,'50','APRUEBA','2016-09-06 20:17:50.750','APRUEBA','$fechahoy'  from sii_callcenter..tbAgente where IdPersona collate Latin1_General_CI_AS in ( select idusuario from  SEG_Perfil where idRol = '504') and not IdPersona in (select IdPersonaAgente from sii_callcenter..tbPuestoAgente)
                    

                ");

              

        }else{///GRUPO COBRANZA
                
                    $usersCOBRANZA = DB::connection('sqlsrv2')->statement
                    ("
                    
                    INSERT INTO SEG_Usuario
                    VALUES 
                    ('$usuarioSII','a0ed203a03ad601a9da7f4e8124b95f5','$nombreSII1','$apellidoSII1','$apellidoSII1  $apellidoSII2  $nombreSII1  $nombreSII2','N','','A','USER','$fechahoy','USER','$fechahoy','')
            
                    
                    INSERT INTO SEG_Perfil
                    SELECT '1', idUsuario , '508', usrIng ,fecIng , usrMod,fecMod   FROM SEG_Usuario 
                    WHERE NOT idUsuario IN (SELECT idUsuario FROM SEG_Perfil)
            
                    
                    SELECT idUsuario , '2','1', nombreCompleto , nombre , usrIng,  usrIng ,apellido , ' ', '0' , fecMod , fecMod FROM SEG_Usuario 
                    WHERE NOT idUsuario COLLATE SQL_Latin1_General_CP1_CI_AS IN (SELECT IdPersona FROM  SII_COBRANZA..tbPersona) AND NOT idUsuario IN ('ALAAZ',
                    'AUDITOR','CAJA1','CAJA2','CAJA3','CAJA4','CAJAUIO2','CAJAUIO','CCOBRANZA','FMUÑOZ','JGONZAGA','LPARRAGA','MMARTIMEZF','TERRENOGYE','TERRENOUIO')
                    
                    
                    insert into SII_COBRANZA..tbPersona (IdPersona , TipoIdentificacionTabla , TipoIdentificacion , NombreLargo , Nombre ,UsuEdicion ,UsuRegistro, Apellido , DireccionPrincipal, TelefonoPrincipal,FecRegistro, FecEdicion)
                    SELECT idUsuario , '2','1', nombreCompleto , nombre , usrIng,  usrIng ,apellido , ' ', '0' , fecMod , fecMod
                    FROM SEG_Usuario 
                    WHERE NOT idUsuario COLLATE SQL_Latin1_General_CP1_CI_AS IN (SELECT IdPersona FROM  SII_COBRANZA..tbPersona) AND NOT idUsuario IN ('ALAAZ',
                    'AUDITOR','CAJA1','CAJA2','CAJA3','CAJA4','CAJAUIO2','CAJAUIO','CCOBRANZA','FMUÑOZ','JGONZAGA','LPARRAGA','MMARTIMEZF','TERRENOGYE','TERRENOUIO')
            
                    
                    INSERT INTO SII_COBRANZA..tbAgente (IdPersona , IdPersonaSupervisor , IdEstadoTabla , IdEstado  ,auditor , UsuRegistro , FecRegistro , UsuEdicion , FecEdicion , Puesto , Clave)
                    SELECT IdPersona , 'S5' , '1', 'A','0' , UsuRegistro , FecEdicion , UsuRegistro , FecRegistro , '320' , '' FROM SII_COBRANZA..tbPersona WHERE NOT IdPersona IN (SELECT IdPersona FROM Sii_Cobranza..tbAgente)
            

                    ");
                }

               
                
                /**VERIFICAR QUE SEA LIDER O AGENTE. AGENTE=1 LIDER=0 */
                if ($request->rol == 1 || $request->rol == 2) {
                    

                $usersPREDICTIVO1 = DB::connection('asterisk')->statement
                ("
                    INSERT INTO `vicidial_users` ( `user`, `pass`, `full_name`, `user_level`, `user_group`, `phone_login`, `phone_pass`, `delete_users`, `delete_user_groups`, `delete_lists`, `delete_campaigns`, `delete_ingroups`, `delete_remote_agents`, `load_leads`, `campaign_detail`, `ast_admin_access`, `ast_delete_phones`, `delete_scripts`, `modify_leads`, `hotkeys_active`, `change_agent_campaign`, `agent_choose_ingroups`, `closer_campaigns`, `scheduled_callbacks`, `agentonly_callbacks`, `agentcall_manual`, `vicidial_recording`, `vicidial_transfers`, `delete_filters`, `alter_agent_interface_options`, `closer_default_blended`, `delete_call_times`, `modify_call_times`, `modify_users`, `modify_campaigns`, `modify_lists`, `modify_scripts`, `modify_filters`, `modify_ingroups`, `modify_usergroups`, `modify_remoteagents`, `modify_servers`, `view_reports`, `vicidial_recording_override`, `alter_custdata_override`, `qc_enabled`, `qc_user_level`, `qc_pass`, `qc_finish`, `qc_commit`, `add_timeclock_log`, `modify_timeclock_log`, `delete_timeclock_log`, `alter_custphone_override`, `vdc_agent_api_access`, `modify_inbound_dids`, `delete_inbound_dids`, `active`, `alert_enabled`, `download_lists`, `agent_shift_enforcement_override`, `manager_shift_enforcement_override`, `shift_override_flag`, `export_reports`, `delete_from_dnc`, `email`, `user_code`, `territory`, `allow_alerts`, `agent_choose_territories`, `custom_one`, `custom_two`, `custom_three`, `custom_four`, `custom_five`, `voicemail_id`, `agent_call_log_view_override`, `callcard_admin`, `agent_choose_blended`, `realtime_block_user_info`, `custom_fields_modify`, `force_change_password`, `agent_lead_search_override`, `modify_shifts`, `modify_phones`, `modify_carriers`, `modify_labels`, `modify_statuses`, `modify_voicemail`, `modify_audiostore`, `modify_moh`, `modify_tts`, `preset_contact_search`, `modify_contacts`, `modify_same_user_level`, `admin_hide_lead_data`, `admin_hide_phone_data`, `agentcall_email`, `modify_email_accounts`, `failed_login_count`, `last_login_date`, `last_ip`, `pass_hash`, `alter_admin_interface_options`, `max_inbound_calls`, `modify_custom_dialplans`, `wrapup_seconds_override`, `modify_languages`, `selected_language`, `user_choose_language`, `ignore_group_on_search`, `api_list_restrict`, `api_allowed_functions`, `lead_filter_id`, `admin_cf_show_hidden`, `agentcall_chat`, `user_hide_realtime`, `access_recordings`, `modify_colors`, `user_nickname`, `user_new_lead_limit`, `api_only_user`, `modify_auto_reports`, `modify_ip_lists`, `ignore_ip_list`, `ready_max_logout`, `export_gdpr_leads`, `pause_code_approval`, `max_hopper_calls`, `max_hopper_calls_hour`) VALUES
                    ('$usuarioSII', '123456', '$usuarioSII', 1, '$area', '', '123456', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', NULL, '1', '0', '0', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 'DISABLED', 'NOT_ACTIVE', '0', 1, '0', '0', '0', '0', '0', '0', 'NOT_ACTIVE', '0', '0', '0', 'Y', '0', '0', 'DISABLED', '0', '0', '0', '0', '', '', '', '0', '1', '', '', '', '', '', NULL, 'DISABLED', '0', '1', '0', '0', 'N', 'NOT_ACTIVE', '0', '0', '0', '0', '0', '0', '0', '0', '0', 'NOT_ACTIVE', '0', '1', '0', '0', '0', '0', 0, '$fechahoy', '', '', '1', 0, '0', -1, '0', 'default English', '0', '0', '0', ' ALL_FUNCTIONS ', 'NONE', '0', '0', '0', '0', '0', '', -1, '0', '0', '0', '0', -1, '0', '0', 0, 0);

                ");
                $usersPREDICTIVO2 = DB::connection('asterisk')->statement
                ("
            
                    INSERT INTO `vicidial_inbound_group_agents` (`user`, `group_id`, `group_rank`, `group_weight`, `calls_today`, `group_web_vars`, `group_grade`, `group_type`) VALUES
                        ('$usuarioSII', 'AGENTDIRECT', 0, 0, 0, '', 1, 'C'),
                        ('$usuarioSII', 'AGENTDIRECT_CHAT', 0, 0, 0, '', 1, 'C');
                     
                ");

                $usersPREDICTIVO3 = DB::connection('asterisk')->statement
                ("
                  
                        INSERT INTO `vicidial_campaign_agents` (`user`, `campaign_id`, `campaign_rank`, `campaign_weight`, `calls_today`, `group_web_vars`, `campaign_grade`, `hopper_calls_today`, `hopper_calls_hour`) VALUES
                        ('$usuarioSII', 'CMP005', 0, 0, 0, '', 1, 0, 0),
                        ('$usuarioSII', 'CMP010', 0, 0, 0, '', 1, 0, 0)
                ");
            }else {
                $usersPREDICTIVO1 = DB::connection('asterisk')->statement
                ("
                    INSERT INTO `vicidial_users` ( `user`, `pass`, `full_name`, `user_level`, `user_group`, `phone_login`, `phone_pass`, `delete_users`, `delete_user_groups`, `delete_lists`, `delete_campaigns`, `delete_ingroups`, `delete_remote_agents`, `load_leads`, `campaign_detail`, `ast_admin_access`, `ast_delete_phones`, `delete_scripts`, `modify_leads`, `hotkeys_active`, `change_agent_campaign`, `agent_choose_ingroups`, `closer_campaigns`, `scheduled_callbacks`, `agentonly_callbacks`, `agentcall_manual`, `vicidial_recording`, `vicidial_transfers`, `delete_filters`, `alter_agent_interface_options`, `closer_default_blended`, `delete_call_times`, `modify_call_times`, `modify_users`, `modify_campaigns`, `modify_lists`, `modify_scripts`, `modify_filters`, `modify_ingroups`, `modify_usergroups`, `modify_remoteagents`, `modify_servers`, `view_reports`, `vicidial_recording_override`, `alter_custdata_override`, `qc_enabled`, `qc_user_level`, `qc_pass`, `qc_finish`, `qc_commit`, `add_timeclock_log`, `modify_timeclock_log`, `delete_timeclock_log`, `alter_custphone_override`, `vdc_agent_api_access`, `modify_inbound_dids`, `delete_inbound_dids`, `active`, `alert_enabled`, `download_lists`, `agent_shift_enforcement_override`, `manager_shift_enforcement_override`, `shift_override_flag`, `export_reports`, `delete_from_dnc`, `email`, `user_code`, `territory`, `allow_alerts`, `agent_choose_territories`, `custom_one`, `custom_two`, `custom_three`, `custom_four`, `custom_five`, `voicemail_id`, `agent_call_log_view_override`, `callcard_admin`, `agent_choose_blended`, `realtime_block_user_info`, `custom_fields_modify`, `force_change_password`, `agent_lead_search_override`, `modify_shifts`, `modify_phones`, `modify_carriers`, `modify_labels`, `modify_statuses`, `modify_voicemail`, `modify_audiostore`, `modify_moh`, `modify_tts`, `preset_contact_search`, `modify_contacts`, `modify_same_user_level`, `admin_hide_lead_data`, `admin_hide_phone_data`, `agentcall_email`, `modify_email_accounts`, `failed_login_count`, `last_login_date`, `last_ip`, `pass_hash`, `alter_admin_interface_options`, `max_inbound_calls`, `modify_custom_dialplans`, `wrapup_seconds_override`, `modify_languages`, `selected_language`, `user_choose_language`, `ignore_group_on_search`, `api_list_restrict`, `api_allowed_functions`, `lead_filter_id`, `admin_cf_show_hidden`, `agentcall_chat`, `user_hide_realtime`, `access_recordings`, `modify_colors`, `user_nickname`, `user_new_lead_limit`, `api_only_user`, `modify_auto_reports`, `modify_ip_lists`, `ignore_ip_list`, `ready_max_logout`, `export_gdpr_leads`, `pause_code_approval`, `max_hopper_calls`, `max_hopper_calls_hour`) VALUES
                    ('$usuarioSII', '123456', '$usuarioSII', 9, '$area', '', '123456', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '1', '1', '', '1', '0', '0', '1', '1', '1', '1', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'DISABLED', 'NOT_ACTIVE', '0', 1, '0', '0', '0', '1', '1', '1', 'NOT_ACTIVE', '1', '1', '1', 'Y', '0', '1', 'DISABLED', '1', '0', '1', '1', '', '', '', '0', '0', '', '', '', '', '', '', 'DISABLED', '1', '1', '0', '0', 'N', 'NOT_ACTIVE', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'NOT_ACTIVE', '1', '1', '0', '0', '0', '0', 6, '$fechahoy', '', '', '1', 0, '1', -1, '0', 'default English', '0', '0', '0', ' ALL_FUNCTIONS ', 'NONE', '0', '0', '0', '0', '1', '', -1, '0', '0', '0', '0', -1, '0', '1', 0, 0);

                ");
                $usersPREDICTIVO2 = DB::connection('asterisk')->statement
                ("
            
                    INSERT INTO `vicidial_inbound_group_agents` (`user`, `group_id`, `group_rank`, `group_weight`, `calls_today`, `group_web_vars`, `group_grade`, `group_type`) VALUES
                        ('$usuarioSII', 'AGENTDIRECT', 0, 0, 0, '', 1, 'C'),
                        ('$usuarioSII', 'AGENTDIRECT_CHAT', 0, 0, 0, '', 1, 'C');
                     
                ");

                $usersPREDICTIVO3 = DB::connection('asterisk')->statement
                ("
                  
                        INSERT INTO `vicidial_campaign_agents` (`user`, `campaign_id`, `campaign_rank`, `campaign_weight`, `calls_today`, `group_web_vars`, `campaign_grade`, `hopper_calls_today`, `hopper_calls_hour`) VALUES
                        ('$usuarioSII', 'CMP005', 0, 0, 0, '', 1, 0, 0),
                        ('$usuarioSII', 'CMP010', 0, 0, 0, '', 1, 0, 0)
                ");
            }

        $user->save();



        return redirect()->route('users.edit', $user->id)->with('msg', 'Usuario registrado !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('usuarioRoles')
                    ->with('cargosDepartamento')
                    ->findOrFail($id);
                    
        return view('users.show', ['user' => $user]);
    }


    public function getNickname($nombre1, $nombre2, $apellido_paterno, $apellido_materno)
    {
        $nick = $nombre1[0].''.$apellido_paterno;
        
        $findUserNick1 = User::searchWhere('usuario', '=', $nick)->first();

        if (!empty($findUserNick1)) 
        {
            $nick .= $apellido_materno[0];

            $findUserNick2 = User::searchWhere('usuario', '=', $nick)->first();

            if (!empty($findUserNick2)) 
            {
                $nick .= $nombre2[0];
            }
        }

        return $nick;
    }


    /**
     * Assign position for user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function position ($id)
    {
        $user = User::findOrFail($id);
        $empresas = Empresa::with('departamentosEmpresa')->orderBy('nombre_empresa', 'asc')->get();
        $cargos = Cargo::orderBy('nombre_cargo', 'asc')->get();
        $departamento = Departamento::orderBy('nombre_departamento', 'asc')->get();
        return view('users.position', ['user' => $user, 'empresas' => $empresas, 'cargos' => $cargos, 'departamento' => $departamento]);
    }


    /**
     * Save assign position for user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assign (Request $request, User $user)
    {
        $validate = \Validator::make($request->all(), [          
            'departamento' => 'required',
            'cargo' => 'required'
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }

        $exist = CargoDepartamento::searchWhere('user_id', '=', $user->id)
                    ->searchWhere('cargo_id', '=', $request->cargo)
                    ->searchWhere('deptempresa_id', '=', $request->departamento)->first();
//dd($user);
        if (!empty($exist))
        {
            return redirect()->back()->with('error', 'Lo sentimos, el usuario que seleccionó ya tiene ese cargo asignado !!');
        }
        else
        {
            $cdept = new CargoDepartamento();
            $cdept->user_id = $user->id;
            $cdept->cargo_id = $request->cargo;
            $cdept->deptempresa_id = $request->departamento;
            $cdept->save();

            return redirect()->route('users.index')->with('msg', 'Se ha asignado al usuario '.$user->nombre1.' '.$user->apellido_paterno.' en el cargo de '.$cdept->cargo->nombre_cargo.' en el departamento de '.$cdept->departamentoEmpresa->departamento->nombre_departamento.' de la empresa '.$cdept->departamentoEmpresa->empresa->nombre_empresa);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $generos = Genero::orderBy('id', 'asc')->get();
        $roles = Role::orderBy('id', 'desc')->get();
        $user = User::with(['usuarioRoles', 'genero'])->findOrFail($id);

        return view('users.edit', ['user' => $user, 'roles' => $roles, 'generos' => $generos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //DD($request);
        $validate = \Validator::make($request->all(), [          
            'cedula' => ['required','ecuador:ci','unique:users,cedula,'.$user->id],
            'nombre1' => 'required',
            'nombre2' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'genero_id' => 'required',
            'fecha_nacimiento' => 'required|date_format:"Y-m-d"'
        ]);
 
        if ($validate->fails())
        {
            return redirect()->back()->withInput()->withErrors($validate->errors());
        }

        $user->cedula = $request->cedula;
        $user->nombre1 = $request->nombre1;
        $user->nombre2 = $request->nombre2;
        $user->apellido_paterno = $request->apellido_paterno;
        $user->apellido_materno = $request->apellido_materno;
        $user->direccion = $request->direccion;
        $user->celular = $request->celular;
        $user->telefono = $request->telefono;        
        $user->estado_civil = $request->estado_civil;
        $user->email = $request->email;
        $user->genero_id = $request->genero_id;
        $user->discapacidad = $request->discapacidad;
        $user->comentario = $request->comentario;
        $user->extension = $request->extension;

       // $user->usuario = $this->getNickname(strtolower($request->nombre1), strtolower($request->nombre2), strtolower($request->apellido_paterno), strtolower($request->apellido_materno));
        
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->enabled = $request->enabled;
        $user->update();

        $user->roles()->sync($request->get('roles'));

        return redirect()->route('users.edit', $user->id)->with('msg', 'Usuario actualizado !!');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('msg', 'Usuario borrado !!');
    }




    public function import()
    {   
      

        return view('Import.user');
    }

    public function importUsers(Request $request)
    {
        //dd($request);

        Excel::import(new ImportUsers,request()->file('file'));

        return redirect()->route('inicio')
        ->with('info', 'Archivo Guardada con Éxito');


       
    }

  

  

}
