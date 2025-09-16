import React from "react";
import { Link } from "@inertiajs/react";

export default function Nav() {
  return (
    <>
      {/* Top Navbar */}
      <nav className="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div className="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <div className="me-3">
            <button
              className="navbar-toggler navbar-toggler align-self-center"
              type="button"
              data-bs-toggle="minimize"
            >
              <span className="icon-menu"></span>
            </button>
          </div>
          <div>
            <Link className="navbar-brand brand-logo" href="/">
              <img src="/assets/images/logo.svg" alt="logo" />
            </Link>
            <Link className="navbar-brand brand-logo-mini" href="/">
              <img src="/assets/images/logo-mini.svg" alt="logo" />
            </Link>
          </div>
        </div>

        <div className="navbar-menu-wrapper d-flex align-items-top">
          <ul className="navbar-nav">
            <li className="nav-item fw-semibold d-none d-lg-block ms-0">
              <h1 className="welcome-text">
                Good Morning, <span className="text-black fw-bold">John Doe</span>
              </h1>
              <h3 className="welcome-sub-text">Your performance summary this week</h3>
            </li>
          </ul>

          <ul className="navbar-nav ms-auto">
            {/* Example dropdown */}
            <li className="nav-item dropdown d-none d-lg-block">
              <a
                className="nav-link dropdown-bordered dropdown-toggle dropdown-toggle-split"
                id="messageDropdown"
                href="#"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Select Category
              </a>
              <div
                className="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                aria-labelledby="messageDropdown"
              >
                <a className="dropdown-item py-3">
                  <p className="mb-0 fw-medium float-start">Select category</p>
                </a>
                <div className="dropdown-divider"></div>
                <a className="dropdown-item preview-item">
                  <div className="preview-item-content flex-grow py-2">
                    <p className="preview-subject ellipsis fw-medium text-dark">
                      Bootstrap Bundle
                    </p>
                    <p className="fw-light small-text mb-0">
                      This is a Bundle featuring 16 unique dashboards
                    </p>
                  </div>
                </a>
              </div>
            </li>
            {/* Add your other nav items here... */}
          </ul>

          <button
            className="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
            type="button"
            data-bs-toggle="offcanvas"
          >
            <span className="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>

      {/* Sidebar */}
      <div className="container-fluid page-body-wrapper">
        <nav className="sidebar sidebar-offcanvas" id="sidebar">
          <ul className="nav">
            <li className="nav-item">
              <Link className="nav-link" href="/">
                <i className="mdi mdi-grid-large menu-icon"></i>
                <span className="menu-title">Dashboard</span>
              </Link>
            </li>
            <li className="nav-item nav-category">UI Elements</li>
            <li className="nav-item">
              <a
                className="nav-link"
                data-bs-toggle="collapse"
                href="#ui-basic"
                aria-expanded="false"
                aria-controls="ui-basic"
              >
                <i className="menu-icon mdi mdi-floor-plan"></i>
                <span className="menu-title">UI Elements</span>
                <i className="menu-arrow"></i>
              </a>
              <div className="collapse" id="ui-basic">
                <ul className="nav flex-column sub-menu">
                  <li className="nav-item">
                    <Link className="nav-link" href="/ui/buttons">
                      Buttons
                    </Link>
                  </li>
                  <li className="nav-item">
                    <Link className="nav-link" href="/ui/dropdowns">
                      Dropdowns
                    </Link>
                  </li>
                  <li className="nav-item">
                    <Link className="nav-link" href="/ui/typography">
                      Typography
                    </Link>
                  </li>
                </ul>
              </div>
            </li>
            {/* Add the rest of sidebar menus here */}
          </ul>
        </nav>
      </div>
    </>
  );
}
