
import {render} from 'react-dom';

import './style.less';


import { Router, Route, hashHistory } from 'react-router';


const routes = <Router history={hashHistory}>
                <Route path="/login" component={require('componentsDir/admin/login.jsx')}/>
              </Router>

render(routes, document.getElementById('container'));

window.location.href='#/login';
