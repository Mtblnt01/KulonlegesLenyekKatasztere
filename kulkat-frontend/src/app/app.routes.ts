import { Routes } from '@angular/router';
import { Login } from './auth/login/login';
import { Create } from './creatures/create/create';
import { Details } from './creatures/details/details';
import { Edit } from './creatures/edit/edit';
import { Gallery } from './creatures/gallery/gallery';
import { Contact } from './contact/contact/contact';
import { List } from './creatures/list/list';
import { authGuard } from './auth/auth-guard';

export const routes: Routes = [
  { path: 'auth', component: Login },
  { path: 'creatures', component: List, canActivate: [authGuard] },
  { path: 'creatures/new', component: Create, canActivate: [authGuard] },
  { path: 'creatures/:id', component: Details, canActivate: [authGuard] },
  { path: 'creatures/:id/edit', component: Edit, canActivate: [authGuard] },
  { path: 'creatures/:id/gallery', component: Gallery, canActivate: [authGuard] },
  { path: 'contact', component: Contact, canActivate: [authGuard] }
];
