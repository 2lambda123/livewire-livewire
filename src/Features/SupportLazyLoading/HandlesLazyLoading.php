<?php

namespace Livewire\Features\SupportLazyLoading;

trait HandlesLazyLoading
{
    public function placeholder()
    {
        return <<<'HTML'
        <div>
            <style> @keyframes float { 0% { transform: translatey(0px); } 50% { transform: translatey(-10px); } 100% { transform: translatey(0px); } } </style>
            <svg width="24" height="24" style="animation: float 2s ease-in-out infinite;" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 864 864"><path class="spinner_rXNP" fill="none" d="M487 865H1.000108c-.000036-287.999878-.000036-575.999725-.000072-863.999698 287.99975-.000101 575.999537-.000101 863.999476-.000201.000122 287.999594.000122 575.999289.000305 863.999411C739.166687 865 613.333313 865 487 865M239.920471 586.875488c.005814 16.158936-.251388 32.323181.076264 48.475586.555709 27.395264 27.065734 47.560913 53.700744 41.142151 20.375183-4.910217 33.94046-22.157959 34.119446-43.688232.174408-20.985657.150116-41.972962.819275-62.653626.602966.57251 1.216095 1.134644 1.807342 1.718994 17.127503 16.927002 37.794587 15.974549 52.946106-2.748291 4.574921-5.653198 8.338532-11.963012 12.617829-17.070923.07962 12.967103.159271 25.934266.098907 39.834961-.008117 40.797242-.263946 81.596497.081574 122.390747.169372 20.000428 9.462097 35.281678 27.601532 44.008728 17.886444 8.605408 35.401367 6.63556 51.218963-5.41101 13.047608-9.937012 18.889618-23.6969 18.910767-39.989136.057526-44.291931.09668-88.583923.870758-132.760315 15.539856 6.696472 27.936035 4.44397 39.34198-7.875671 4.370728-4.720887 7.715271-10.388062 11.562256-15.598389 5.405334-7.321045 10.843017-14.618225 16.404053-20.94104.062011 17.754089.124023 35.508118.040405 54.191895.00824 21.823181-.1969 43.649108.07904 65.468933.341187 26.981628 22.445069 46.498474 49.123413 43.769348 21.348694-2.183899 38.441224-20.542603 38.661805-42.075501.259277-25.318603.128784-50.641113.861145-75.730896 3.057922.576905 6.115844 1.15387 9.715393 1.869934.371338-.011718.742737-.023498 1.67395.371888.888672-.009644 1.777344-.019288 3.483887.107544 8.769653-.066346 16.92688-2.091431 23.160156-8.624878 3.533325-3.703492 6.65271-7.870667 9.531433-12.118409 16.141602-23.817627 24.736694-50.774292 30.282105-78.517547 4.08435-20.43393 6.384765-41.34195 7.794311-62.152893.992188-14.648682-.846497-29.489106-1.33844-45.15799-2.075683-29.375274-8.749267-57.749878-19.15271-85.221313-23.367981-61.705612-61.791809-111.837464-116.186584-149.398667-44.841065-30.964027-94.703949-47.900245-148.994599-51.239532-23.432403-1.441269-46.815704.174705-70.009582 4.571075-58.572602 11.102341-108.976349 37.843659-151.87114 78.903977-28.329452 27.117874-50.480728 58.750946-67.044983 94.304474-17.466552 37.490234-27.397506 76.95166-29.663086 118.162109-1.204559 21.910736-.543075 43.859924 2.608399 65.726624 5.804886 40.277801 18.367081 78.176178 38.307709 113.62918 10.816391 19.230774 37.01329 23.044495 52.397079 7.248536 5.399826-5.544495 9.488846-12.365662 14.290588-17.706482.08223 9.951233.164444 19.902404.07251 30.784057z"/><path fill="#FB70A9" d="M561.961121 534.725525c-5.42389 7.307312-10.861573 14.604492-16.266907 21.925537-3.846985 5.210327-7.191528 10.877502-11.562256 15.598389-11.405945 12.319641-23.802124 14.572143-39.914703 7.554748-11.412537-7.210937-18.025574-17.845276-25.444153-27.865417-4.978913-6.724915-10.938172-12.724182-16.645508-19.343323-11.694061-9.74762-28.218353-10.646362-39.481079-2.183044-7.290009 5.478088-12.759674 12.553222-16.783112 20.737548-4.135223 6.009095-7.898834 12.318909-12.473755 17.972107-15.151519 18.72284-35.818603 19.675293-52.946106 2.748291-.591247-.58435-1.204376-1.146484-2.263183-2.164184-5.149353-7.063599-9.527527-13.937439-14.624542-20.228943-5.170899-6.382691-11.051667-12.190308-16.876313-18.492005-13.991363-9.757141-30.914032-8.598266-42.298324 3.662659-5.675461 6.112427-9.813767 13.6521-14.6474 20.546143-4.687561 6.23822-8.776581 13.059387-14.176407 18.603882-15.383789 15.795959-41.580688 11.982238-52.397079-7.248536-19.940628-35.453002-32.502823-73.351379-38.307709-113.62918-3.151474-21.8667-3.812958-43.815888-2.608399-65.726624 2.26558-41.210449 12.196534-80.671875 29.663086-118.162109 16.564255-35.553528 38.715531-67.1866 67.044983-94.304474 42.894791-41.060318 93.298538-67.801636 151.87114-78.903977 23.193878-4.39637 46.577179-6.012344 70.009582-4.571075 54.29065 3.339287 104.153534 20.275505 148.994599 51.239532 54.394775 37.561203 92.818603 87.693055 116.186584 149.398667 10.403443 27.471435 17.077027 55.846039 18.815064 85.397278-1.145508-5.21283-1.944703-10.602936-2.762635-15.990235-4.569946-30.101349-13.953369-58.71878-27.053039-86.1138-10.938843-22.876099-24.721192-43.990784-40.949158-63.480072-2.795288-3.357071-5.980835-6.38913-8.986145-9.571319 2.637634 8.679946 6.1651 16.532608 9.714478 24.375366 16.849609 37.231353 29.365661 75.784424 35.35968 116.310394 3.445862 23.297363 6.498108 46.637878 3.851623 70.261292-1.914428 17.089355-3.057434 34.341522-6.265197 51.193511-6.411805 33.683625-18.636536 65.405488-35.477539 95.312958-3.467469 6.157959-6.839173 12.369934-10.342103 18.714661 3.047425 1.788391 5.583008 3.276428 8.118653 4.764465-3.057923-.576965-6.115845-1.15393-9.779907-2.084594-11.029908-5.50647-17.49762-14.607911-24.157959-23.613099-5.418213-7.325805-11.273133-14.328674-17.083802-21.776977-2.437072-2.190796-4.583374-4.290711-7.036438-5.932312-12.191223-8.158264-32.157898-6.138001-40.018615 5.067871m-76.854096-58.033966c29.523163-9.1745 53.816437-25.485779 69.775299-52.497223 19.85846-33.611694 23.884278-70.497589 18.579407-108.15567-6.271484-44.519562-27.592712-81.421295-63.293854-109.085984-35.029144-27.143936-74.588165-37.052124-117.986847-25.983306-44.611389 11.378082-76.195556 39.798019-97.772064 79.597457-21.869507 40.339966-25.526672 83.19452-14.518433 127.339295 11.607514 46.548035 40.941346 76.438904 87.106568 89.233002 39.02951 10.816467 78.238769 10.075836 118.109924-.447571m168.470978-276.166535s-.105103.063218 0 0z"/><path fill="#4F56A6" d="M452.314331 532.890625c5.520599 6.323975 11.479858 12.323242 16.458771 19.048157 7.418579 10.020141 14.031616 20.65448 25.080292 27.807678.162506 44.555054.123352 88.847046.065826 133.138977-.021149 16.292236-5.863159 30.052124-18.910767 39.989136-15.817596 12.04657-33.332519 14.016418-51.218963 5.41101-18.139435-8.72705-27.43216-24.0083-27.601532-44.008728-.34552-40.79425-.089691-81.593505.316559-122.914428 4.283233-3.572022 8.949524-6.013245 11.889526-9.796143 5.978882-7.692993 11.072296-16.079712 16.444977-24.236999 6.986114-10.606934 14.049438-21.088379 27.475311-24.43866zm156.851196 3.001587c5.661316 7.146057 11.516236 14.148926 16.934449 21.474731 6.660339 9.005188 13.128051 18.106629 23.811035 23.497559.220703 25.559082.351196 50.881592.091919 76.200195-.220581 21.532898-17.313111 39.891602-38.661805 42.075501-26.678344 2.729126-48.782226-16.78772-49.123413-43.769348-.27594-21.819825-.0708-43.645752.325013-65.986817 4.414428-4.123047 9.119629-7.208618 12.286926-11.444214 6.122558-8.187744 11.22052-17.132812 17.043213-25.556518 4.593811-6.645874 9.400024-13.231079 17.292663-16.491089z"/><path fill="#E24DA6" d="M660.308655 583.134155c-2.806458-1.557556-5.342041-3.045593-8.389466-4.833984 3.50293-6.344727 6.874634-12.556702 10.342103-18.714661 16.841003-29.90747 29.065734-61.629333 35.477539-95.312958 3.207763-16.851989 4.350769-34.104156 6.265197-51.193511 2.646485-23.623414-.405761-46.963929-3.851623-70.261292-5.994019-40.52597-18.510071-79.079041-35.35968-116.310394-3.549378-7.842758-7.076844-15.69542-9.714478-24.375366 3.00531 3.182189 6.190857 6.214248 8.986145 9.571319 16.227966 19.489288 30.010315 40.603973 40.949158 63.480072 13.09967 27.39502 22.483093 56.012451 27.053039 86.1138.817932 5.387299 1.617127 10.777405 2.721253 16.447296.870971 15.035858 2.709656 29.876282 1.717468 44.524964-1.409546 20.810943-3.709961 41.718963-7.794311 62.152893-5.545411 27.743255-14.140503 54.69992-30.282105 78.517547-2.878723 4.247742-5.998108 8.414917-9.531433 12.118409-6.233276 6.533447-14.390503 8.558532-23.848389 8.383911-1.57727-.251892-2.46643-.262757-3.35553-.273743-.371337.01178-.742736.02356-1.384887-.034302z"/><path fill="#4F57A6" d="M296.934265 531.227478c5.569885 6.059448 11.450653 11.867065 16.621552 18.249756 5.097015 6.291504 9.475189 13.165344 14.321441 20.075989.089783 21.278808.114075 42.266113-.060333 63.25177-.178986 21.530273-13.744263 38.778015-34.119446 43.688232-26.63501 6.418762-53.145035-13.746887-53.700744-41.142151-.327652-16.152405-.07045-32.31665.300567-49.089233 6.629654-9.12262 12.759949-17.725159 19.172699-26.111817 5.487885-7.177063 10.924774-14.457092 17.081787-21.039184 5.308594-5.675049 13.043732-6.626343 20.382477-7.883362z"/><path fill="#373D75" d="M452.127625 532.595459c-13.239167 3.645447-20.302491 14.126892-27.288605 24.733826-5.372681 8.157287-10.466095 16.544006-16.444977 24.236999-2.940002 3.782898-7.606293 6.224121-11.81955 9.329346-.407745-12.910217-.487396-25.87738-.639068-39.295044 3.951416-8.634949 9.421081-15.710083 16.71109-21.188171 11.262726-8.463318 27.787018-7.564576 39.48111 2.183044z"/><path fill="#373C74" d="M609.016174 535.589966c-7.743286 3.562256-12.549499 10.147461-17.14331 16.793335-5.822693 8.423706-10.920655 17.368774-17.043213 25.556518-3.167297 4.235596-7.872498 7.321167-12.214111 10.97937-.39325-17.701049-.455262-35.455078-.585877-53.701416 7.792175-11.69812 27.75885-13.718383 39.950073-5.560119 2.453064 1.641601 4.599366 3.741516 7.036438 5.932312z"/><path fill="#373D75" d="M296.679504 530.985229c-7.083984 1.499268-14.819122 2.450562-20.127716 8.125611-6.157013 6.582092-11.593902 13.862121-17.081787 21.039184-6.41275 8.386658-12.543045 16.989197-19.085617 25.646607-.371979-9.802796-.454193-19.753967-.593521-30.153931 4.77655-7.342712 8.914856-14.882385 14.590317-20.994812 11.384292-12.260925 28.306961-13.4198 42.298324-3.662659z"/><path fill="#FB70A9" d="M661.973511 583.37207c.609131-.192627 1.498291-.181762 2.666626.001953-.609375.182312-1.498047.191956-2.666626-.001953z"/><path fill="#FFF" d="M484.71521 476.79068c-39.47934 10.424286-78.688599 11.164917-117.718109.34845-46.165222-12.794098-75.499054-42.684967-87.106568-89.233002-11.008239-44.144775-7.351074-86.999329 14.518433-127.339295 21.576508-39.799438 53.160675-68.219375 97.772064-79.597457 43.398682-11.068818 82.957703-1.16063 117.986847 25.983306 35.701142 27.664689 57.02237 64.566422 63.293854 109.085984 5.304871 37.658081 1.279053 74.543976-18.579407 108.15567-15.958862 27.011444-40.252136 43.322723-70.167114 52.596344M359.848328 338.659698c13.987457 6.907715 28.358612 8.032288 43.018524 2.493561 30.021545-11.342621 45.234924-46.059143 34.335113-78.09674-9.606262-28.235459-37.403686-44.779465-64.496582-38.385987-23.907074 5.641693-41.135711 25.70018-44.517364 51.829407-3.228424 24.945526 9.321319 49.914947 31.660309 62.159759z"/><path fill="#E24DA6" d="M653.525452 200.556641c-.052552.031601.052551-.031617 0 0z"/><path fill="#050977" d="M359.536926 338.456543c-22.027588-12.041657-34.577331-37.011078-31.348907-61.956604 3.381653-26.129227 20.61029-46.187714 44.517364-51.829407 27.092896-6.393478 54.89032 10.150528 64.496582 38.385987 10.899811 32.037597-4.313568 66.754119-34.335113 78.09674-14.659912 5.538727-29.031067 4.414154-43.329926-2.696716m-12.799774-67.995789c1.017029 16.229309 13.207916 27.841034 28.883118 27.510834 14.846924-.312775 27.262146-12.767151 27.420166-27.506775.162536-15.159378-11.949524-27.937927-26.95929-28.442749-15.937683-.536026-28.333679 11.089691-29.343994 28.43869z"/><path fill="#FDFDFE" d="M346.737 270.001831c1.010467-16.890076 13.406463-28.515793 29.344146-27.979767 15.009766.504822 27.121826 13.283371 26.95929 28.442749-.15802 14.739624-12.573242 27.194-27.420166 27.506775-15.675202.3302-27.866089-11.281525-28.88327-27.969757z"/></svg>
        </div>
        HTML;
    }
}
