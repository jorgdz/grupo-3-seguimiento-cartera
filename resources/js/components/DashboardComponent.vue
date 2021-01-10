<template>
    <div class="row">
        <div class="col-lg-6" v-for="(pago, index) in pagos" :key="pago.id">
            <div class="card">
                <div
                    :class="[
                        Math.round(pago.campania_id.valor_saldo, 3) > 0
                            ? 'card-header bg-danger'
                            : 'card-header bg-success'
                    ]"
                >
                    <h1 class="card-title text-white">
                        {{ pago.campania_id.campania.nombre_campania }}
                    </h1>
                </div>
                <div class="card-body">
                    <div class="card-horizontal">
                        <div class="img-square-wrapper">
                            <a :href="['users/' + pago.user_id]">
                                <img
                                    class="imgUser"
                                    :src="[pago.user.foto]"
                                    alt="Card image cap"
                                />
                            </a>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">
                                {{ pago.campania_id.cliente.Nombres }}
                                {{ pago.campania_id.cliente.Apellidos }}
                            </h4>
                            <br />
                            <p class="card-text">
                                Valor de la cuota: ${{ pago.cuota }}
                            </p>
                            <p class="card-text">Abono: ${{ pago.abono }}</p>
                            <p class="card-text">
                                Deuda total: ${{ pago.campania_id.valor_deuda }}
                            </p>
                            <p class="card-text">
                                Deuda pendiente: ${{
                                    Math.round(pago.campania_id.valor_saldo, 3)
                                }}
                            </p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">{{ pago.fecha_pago }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            pagos: [],
            socket: null
        };
    },
    methods: {
        getPagos() {
            let me = this;
            axios
                .get("/api/pagos")
                .then(res => {
                    me.pagos = res.data;
                })
                .catch(err => {
                    console.error(err.message);
                });
        }
    },
    mounted() {
        console.log("Componente dashboard montado.");
        var me = this;

        me.getPagos();
        me.socket = new WebSocket("ws://localhost:8090");

        me.socket.onmessage = function(e) {
            console.log(e.data);
            me.getPagos();
        };
    }
};
</script>
